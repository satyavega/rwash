<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        $vouchers = [
            [
                'name' => 'Diskon Rp 10.000',
                'discount_value' => 10000,
                'point_need' => 15,
                'description' => 'Dapatkan diskon Rp 10.000 untuk pembelian apa pun',
            ],
            [
                'name' => 'Diskon Rp 25.000',
                'discount_value' => 25000,
                'point_need' => 40,
                'description' => 'Dapatkan diskon Rp 25.000 untuk pembelian apa pun',
            ],
            [
                'name' => 'Diskon Rp 50.000',
                'discount_value' => 50000,
                'point_need' => 65,
                'description' => 'Dapatkan diskon Rp 50.000 untuk pembelian apa pun',
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
