<?php

namespace App\Http\Controllers\Member;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\PriceList;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TransactionSessionController extends Controller
{
    /**
     * Method to add new transaction to session
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function create()
{
    $members = User::where('role', 'Member')->get();
    return view('member.transactions.create', compact('members'));
}

public function store(Request $request): RedirectResponse
{
    $user = Auth::user();

    $inputData = $request->validate([
        'item'      => ['required'],
        'service'   => ['required'],
        'category'  => ['required'],
        'quantity'  => ['required'],
    ]);

    // Pastikan data member-id tidak kosong
    $inputData['member-id'] = $user->id;

    // Periksa apakah item harga ada di database
    if (!PriceList::where([
        'item_id'     => $inputData['item'],
        'category_id' => $inputData['category'],
        'service_id'  => $inputData['service'],
    ])->exists()) {
        return redirect()->route('member.transactions.create')->with('error', 'Harga tidak ditemukan!');
    }

    // Periksa apakah member ada
    $memberNotExist = !User::where('id', $inputData['member-id'])->where('role', Role::Member)->exists();

    if ($memberNotExist) {
        return redirect()->route('member.transactions.create')->with('error', 'Member tidak ditemukan!');
    }

    // Dapatkan harga item dari database
    $price = PriceList::where([
        'item_id'     => $inputData['item'],
        'category_id' => $inputData['category'],
        'service_id'  => $inputData['service']
    ])->firstOrFail()->price;

    // Hitung subtotal
    $subTotal = $price * $inputData['quantity'];

    // Dapatkan nama item, nama service, dan nama kategori berdasarkan id
    $itemName     = Item::where('id', $inputData['item'])->firstOrFail()->name;
    $serviceName  = Service::where('id', $inputData['service'])->firstOrFail()->name;
    $categoryName = Category::where('id', $inputData['category'])->firstOrFail()->name;

    // Buat baris transaksi baru untuk disimpan dalam sesi
    $rowId = md5($inputData['member-id'] . serialize($inputData['item']) . serialize($inputData['service']) . serialize($inputData['category']));
    $data = [
        $rowId => [
            'itemId'       => $inputData['item'],
            'itemName'     => $itemName,
            'categoryId'   => $inputData['category'],
            'categoryName' => $categoryName,
            'serviceId'    => $inputData['service'],
            'serviceName'  => $serviceName,
            'quantity'     => $inputData['quantity'],
            'subTotal'     => $subTotal,
            'rowId'        => $rowId,
        ]
    ];

    // Simpan data pengiriman jika disertakan
    if ($request->has('delivery_service')) {
        $data[$rowId]['delivery_service'] = $request->input('delivery_service');
    }

    if ($request->has('delivery_charge')) {
        $data[$rowId]['delivery_charge'] = $request->input('delivery_charge');
    }

    // Simpan data transaksi dalam sesi
    if (!$request->session()->has('member_transaction') && !$request->session()->has('memberIdTransaction')) {
        $request->session()->put('member_transaction', $data);
        $request->session()->put('memberIdTransaction', $inputData['member-id']);
    } else {
        $exist = false;
        $sessionTransaction = $request->session()->get('member_transaction');

        if ($sessionTransaction) {
            foreach ($sessionTransaction as &$transaction) {
                if ($transaction['itemId'] == $inputData['item'] && $transaction['categoryId'] == $inputData['category'] && $transaction['serviceId'] == $inputData['service']) {
                    $transaction['quantity'] += $inputData['quantity'];
                    $transaction['subTotal'] += $subTotal;
                    $exist = true;
                    break;
                }
            }

        // Jika tidak ada transaksi yang sama, tambahkan transaksi baru ke sesi
        if (!$exist) {
            $sessionTransaction[$rowId] = $data[$rowId];
            $request->session()->put('member_transaction', $sessionTransaction);
        }
    }
    // dd($request->session()->all()); // Cek semua data sesi setelah proses

    return redirect()->route('member.transactions.create')->with('member_transaction', $sessionTransaction);
}
}
public function destroy(string $rowId, Request $request): RedirectResponse
{
    $sessionTransaction = $request->session()->get('transaction');
    unset($sessionTransaction[$rowId]);

    // Check if after unset, the transaction session is empty ([]), then destroy all transaction session
    if (blank($sessionTransaction)) {
        $request->session()->forget('transaction');
        $request->session()->forget('memberIdTransaction');
        return redirect()->route('member.transactions.create');
    } else {
        $request->session()->put('transaction', $sessionTransaction);
    }

    return redirect()->route('member.transactions.create');
}
}
