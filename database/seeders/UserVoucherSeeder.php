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
        $vouchers = Voucher::all();

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
