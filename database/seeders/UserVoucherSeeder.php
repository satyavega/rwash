<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserVoucher;
use App\Models\User;
use App\Models\Voucher;

class UserVoucherSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan semua voucher
        $vouchers = Voucher::all();

        // Mengaitkan setiap voucher dengan user id 2-9
        foreach ($vouchers as $voucher) {
            foreach (range(2, 9) as $userId) {
                UserVoucher::create([
                    'voucher_id' => $voucher->id,
                    'user_id' => $userId,
                    'used' => false
                ]);
            }
        }
    }
}
