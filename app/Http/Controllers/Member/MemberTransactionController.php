<?php

namespace App\Http\Controllers;

use App\Models\MemberTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Enums\Role;
use App\Models\PriceList;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Status;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberTransactionController extends Controller
{
    public function index(Request $request): View
    {
        $memberTransactions = MemberTransaction::all();
        $currentMonth = $request->input('month', date('m'));
        $currentYear = $request->input('year', date('Y'));

        $user = Auth::user();

        $ongoingTransactions = Transaction::with('member')->whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->where('service_type_id', 1)
            ->where('finish_date', null)
            ->orderBy('created_at', 'DESC')
            ->get();

        $ongoingPriorityTransactions = Transaction::with('member')->whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->where('service_type_id', 2)
            ->where('finish_date', null)
            ->orderBy('created_at', 'DESC')
            ->get();

        $finishedTransactions = Transaction::with('member')->whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->where('finish_date', '!=', null)
            ->orderBy('created_at', 'DESC')
            ->get();

        $status = Status::all();
        $years = Transaction::selectRaw('YEAR(created_at) as Tahun')->distinct()->get();

        return view('member_transactions.index', compact(
            'user',
            'status',
            'years',
            'currentYear',
            'currentMonth',
            'ongoingTransactions',
            'ongoingPriorityTransactions',
            'finishedTransactions',
            'memberTransactions'
        ));
    }

    /**
     * Function to show member input transaction view
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request): View
    {
        $user = Auth::user();
        $items = Item::all();
        $members = User::where('role', Role::Member)->get();
        $categories = Category::all();
        $services = Service::all();
        $serviceTypes = ServiceType::all();

        if ($request->session()->has('transaction') && $request->session()->has('memberIdTransaction')) {
            $sessionTransaction = $request->session()->get('transaction');

            $memberIdSessionTransaction = $request->session()->get('memberIdTransaction');

            $vouchers = UserVoucher::where([
                'user_id' => $memberIdSessionTransaction,
                'used'    => 0,
            ])->get();

            $totalPrice = 0;
            foreach ($sessionTransaction as &$transaction) {
                $totalPrice += $transaction['subTotal'];
            }
            return view('member.transaction_input', compact(
                'user',
                'items',
                'categories',
                'services',
                'serviceTypes',
                'sessionTransaction',
                'memberIdSessionTransaction',
                'totalPrice',
                'vouchers',
                'members',
            ));
        }

        return view('member.transaction_input', compact(
            'user',
            'items',
            'categories',
            'services',
            'serviceTypes',
            'members',
        ));
    }

    /**
     * Store member transaction to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'payment-amount' => ['required', 'integer'],
            'delivery_service' => ['required', 'boolean'],
            'delivery_charge' => ['required_if:delivery_service,true', 'integer'],
        ]);

        DB::beginTransaction();

        $memberId = Auth::id();

        $sessionTransaction = $request->session()->get('transaction');

        $totalPrice = 0;
        foreach ($sessionTransaction as &$trs) {
            $totalPrice += $trs['subTotal'];
        }

        $cost = 0;
        if ($request->input('service-type') != 0) {
            $serviceTypeCost = ServiceType::where('id', $request->input('service-type'))->firstOrFail();
            $cost = $serviceTypeCost->cost;
            $totalPrice += $cost;
        }

        $discount = 0;

        // Check voucher
        if ($request->input('voucher') != 0) {
            $userVoucher = UserVoucher::where('id', $request->input('voucher'))->firstOrFail();
            if (!$userVoucher->voucher) {
                abort(404);
            }

            $discount = $userVoucher->voucher->discount_value;
            $totalPrice -= $discount;
            if ($totalPrice < 0) {
                $totalPrice = 0;
            }

            $userVoucher->used = 1;
            $userVoucher->save();
        }

        // Check if payment < total
        if ($request->input('payment-amount') < $totalPrice) {
            return redirect()->route('member.index')
                ->with('error', 'Pembayaran kurang');
        }

        $transaction = new MemberTransaction([
            'status_id'       => 1,
            'member_id'       => $memberId,
            'admin_id'        => null,
            'finish_date'     => null,
            'discount'        => $discount,
            'total'           => $totalPrice,
            'service_type_id' => $request->input('service-type'),
            'service_cost'    => $cost,
            'payment_amount'  => $request->input('payment-amount'),
            'delivery_service' => $request->input('delivery_service'),
            'delivery_charge' => $request->input('delivery_charge'),
        ]);
        $transaction->save();

        foreach ($sessionTransaction as &$trs) {
            $price = PriceList::where([
                'item_id'     => $trs['itemId'],
                'category_id' => $trs['categoryId'],
                'service_id'  => $trs['serviceId'],
            ])->firstOrFail();

            $transaction_detail = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'price_list_id'  => $price->id,
                'quantity'       => $trs['quantity'],
                'price'          => $price->price,
                'sub_total'      => $trs['subTotal'],
            ]);
            $transaction_detail->save();
        }

        $user = User::where('id', $memberId)->firstOrFail();
        $user->point = $user->point + 1;
        $user->save();

        $request->session()->forget('transaction');

        DB::commit();

        return redirect()->route('member.index')
            ->with('success', 'Transaksi berhasil disimpan')
            ->with('id_trs', $transaction->id);
    }

    public function show(MemberTransaction $memberTransaction)
    {
        // Logika untuk menampilkan detail transaksi anggota
    }

    public function edit(MemberTransaction $memberTransaction)
    {
        // Logika untuk menampilkan form edit transaksi anggota
    }

    public function update(Request $request, MemberTransaction $memberTransaction)
    {
        $request->validate([
            'delivery_service' => 'required|boolean',
            'delivery_charge' => 'required_if:delivery_service,true|integer',
        ]);

        $memberTransaction->update([
            'delivery_service' => $request->delivery_service,
            'delivery_charge' => $request->delivery_charge,
        ]);

        return redirect()->route('member.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(MemberTransaction $memberTransaction)
    {
        $memberTransaction->delete();

        return redirect()->route('member.index')->with('success', 'Transaction deleted successfully.');
    }
}
