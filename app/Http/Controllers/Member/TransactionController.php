<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberTransaction;
use App\Models\Category;
use App\Models\Item;
use App\Enums\Role;
use App\Models\PriceList;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Status;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Method to show transactions history based on current logged on member
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $transactions = Transaction::with('status')->where('member_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy('status_id', 'ASC')
            ->get();

        return view('member.transactions_history', compact('user', 'transactions'));
    }
    public function create(Request $request): View
    {
        $user = Auth::user();
        $items = Item::all();
        $members = User::where('role', Role::Member)->get();
        $categories = Category::all();
        $services = Service::all();
        $serviceTypes = ServiceType::all();
        $vouchers = [];
        $sessionTransaction = null;
        $memberIdSessionTransaction = null;

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
        }

        return view('member.transaction_input', compact(
            'user',
            'items',
            'categories',
            'services',
            'serviceTypes',
            'sessionTransaction',
            'memberIdSessionTransaction',
            'total',
            'vouchers', // Masukkan $vouchers ke dalam kompact
            'members',
        ));
    }


    /**
     * Store member transaction to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $request->validate([
            'price_list_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'service_type_id' => 'nullable|exists:service_types,id',
            'voucher' => 'nullable|exists:user_vouchers,id',
            'delivery_service' => 'nullable|boolean',
            'payment_amount' => 'required|in:cod,transfer',
        ]);

        $priceList = PriceList::findOrFail($request->input('price_list_id'));

        $totalPrice = $priceList->price * $request->input('quantity');

        // Menghitung service cost berdasarkan service type
        $serviceCost = 0;
        if ($request->has('service_type_id')) {
            $serviceType = ServiceType::findOrFail($request->input('service_type_id'));
            $serviceCost = $serviceType->cost ?? 0;
        }

        // Mengurangi discount dari voucher jika ada
        $discount = 0;
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

        // Menambah biaya delivery service jika dipilih
        $deliveryCharge = $request->input('delivery_service') ? 15000 : 0;

        // Menyimpan transaksi
        $transaction = new Transaction([
            'price_list_id' => $priceList->id,
            'quantity' => $request->input('quantity'),
            'price' => $priceList->price,
            'service_type_id' => $request->input('service_type_id'),
            'service_cost' => $serviceCost,
            'discount' => $discount,
            'delivery_service' => $request->input('delivery_service', false),
            'delivery_charge' => $deliveryCharge,
            'payment_amount' => $request->input('payment_amount'),
            'total' => $totalPrice + $serviceCost + $deliveryCharge,
            'user_id' => Auth::id(),
        ]);

        $transaction->save();

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }


    /**
     * Method to show detail transaction
     *
     * @param  string|int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Transaction $transaction): View
    {
        $transaction = $transaction->load([
            'transaction_details',
            'transaction_details.price_list',
            'transaction_details.price_list.item',
            'transaction_details.price_list.service',
            'transaction_details.price_list.category',
            'service_type',
        ]);

        return view('member.transaction_show', compact('transaction'));
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
}
