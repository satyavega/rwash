<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Show voucher page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();
        $vouchers = Voucher::all();

        return view('admin.voucher', compact('user', 'vouchers'));
    }

    /**
     * Add new voucher to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'discount_value' => ['required'],
            'point_need'     => ['required'],
        ]);

        $voucherExists = Voucher::where('discount_value', $input['discount_value'])->exists();

        if ($voucherExists) {
            return redirect()->route('admin.vouchers.index')
                ->with('error', 'Voucher potongan ' . $input['discount_value'] . ' sudah ada');
        }

        $voucher = new Voucher([
            'name'           => 'Potongan ' . number_format($input['discount_value'], 0, ',', '.'),
            'discount_value' => $input['discount_value'],
            'point_need'     => $input['point_need'],
            'description'    => 'Mendapatkan potongan harga ' . number_format($input['discount_value'], 0, ',', '.') . ' dari total transaksi',
            'active_status'  => 1,
        ]);
        $voucher->save();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher baru berhasil ditambah!');
    }

    /**
     * Update voucher status
     *
     * @param  \App\Models\Voucher $voucher
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Voucher $voucher): JsonResponse
    {
        if ($voucher->active_status == 1) {
            $voucher->active_status = 0;
            $voucher->save();
        } else {
            $voucher->active_status = 1;
            $voucher->save();
        }

        return response()->json();
    }
    public function destroy(Voucher $voucher): RedirectResponse
    {
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }

}
