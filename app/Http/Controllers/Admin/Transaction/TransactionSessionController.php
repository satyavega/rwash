<?php

namespace App\Http\Controllers\Admin\Transaction;

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
    $members = User::where('role', 'Member')->get(); // or whatever logic you use to get members
    return view('admin.transactions.create', compact('members'));
}

    public function store(Request $request): RedirectResponse
    {
        dd($request->all());
        $inputData = $request->validate([
            'item'      => ['required'],
            'service'   => ['required'],
            'category'  => ['required'],
            'member-id' => [Rule::requiredIf(!$request->session()->has('memberIdTransaction'))],
            'quantity'  => ['required'],
        ]);
        // dd($inputData);

        // Make sure input data member id is not empty
        $inputData['member-id'] = $inputData['member-id'] ?? $request->session()->get('memberIdTransaction');


        // Check if price list exist in database
        if (!PriceList::where([
            'item_id'     => $inputData['item'],
            'category_id' => $inputData['category'],
            'service_id'  => $inputData['service'],
        ])->exists()) {
            return redirect()->route('admin.transactions.create')->with('error', 'Harga tidak ditemukan!');
        }

        // Check if member exist
        $memberNotExist = !User::where('id', $inputData['member-id'])->where('role', Role::Member)->exists();

        if ($memberNotExist) {
            return redirect()->route('admin.transactions.create')->with('error', 'Member tidak ditemukan!');
        }

        // Get price list's price from database
        $price = PriceList::where([
            'item_id'     => $inputData['item'],
            'category_id' => $inputData['category'],
            'service_id'  => $inputData['service']
        ])->firstOrFail()->price;

        // Calculate sub total
        $subTotal = $price * $inputData['quantity'];

        // Get item name, service name, and category name based on id
        $itemName     = Item::where('id', $inputData['item'])->firstOrFail()->name;
        $serviceName  = Service::where('id', $inputData['service'])->firstOrFail()->name;
        $categoryName = Category::where('id', $inputData['category'])->firstOrFail()->name;

        // make new transaction row to store in session
        $rowId = md5($inputData['member-id'] . serialize($inputData['item']) . serialize($inputData['service']) . serialize($inputData['category']));
        $newData = [
            'itemId'       => $inputData['item'],
            'itemName'     => $itemName,
            'categoryId'   => $inputData['category'],
            'categoryName' => $categoryName,
            'serviceId'    => $inputData['service'],
            'serviceName'  => $serviceName,
            'quantity'     => $inputData['quantity'],
            'subTotal'     => $subTotal,
            'rowId'        => $rowId
        ];

        if (!$request->session()->has('transaction')) {
            $request->session()->put('transaction', [$rowId => $newData]);
        } else {
            $sessionTransaction = $request->session()->get('transaction');
            // Jika item dengan rowId yang sama sudah ada, tambahkan kuantitas dan subtotal
            if (isset($sessionTransaction[$rowId])) {
                $sessionTransaction[$rowId]['quantity'] += $inputData['quantity'];
                $sessionTransaction[$rowId]['subTotal'] += $subTotal;
            } else {
                // Tambahkan item baru ke transaksi
                $sessionTransaction[$rowId] = $newData;
            }
            $request->session()->put('transaction', $sessionTransaction);
        }

        // Pastikan memberIdTransaction juga tersimpan di sesi
        $request->session()->put('memberIdTransaction', $inputData['member-id']);

        return redirect()->route('admin.transactions.create');
    }

    /**
     * Method for delete current transaction in session
     *
     * @param  string $rowId
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $rowId, Request $request): RedirectResponse
    {
        $sessionTransaction = $request->session()->get('transaction');
        unset($sessionTransaction[$rowId]);

        // Check if after unset, the transaction session is empty ([]), then destroy all transaction session
        if (blank($sessionTransaction)) {
            $request->session()->forget('transaction');
            $request->session()->forget('memberIdTransaction');
            return redirect()->route('admin.transactions.create');
        } else {
            $request->session()->put('transaction', $sessionTransaction);
        }

        return redirect()->route('admin.transactions.create');
    }
}
