<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
            // Bahan Kimia dan Pembersih
            [
                'category_id' => 1,
                'date' => now(),
                'total_amount' => 100000,
                'description' => 'Pembelian deterjen dan pelembut pakaian',
            ],
            [
                'category_id' => 1,
                'date' => now(),
                'total_amount' => 50000,
                'description' => 'Pembelian pemutih pakaian dan pewangi pakaian',
            ],
            // Perlengkapan Laundry
            [
                'category_id' => 2,
                'date' => now(),
                'total_amount' => 256000,
                'description' => 'Pembelian ember dan wadah penyimpanan',
            ],
            // Utilitas dan Perawatan
            [
                'category_id' => 3,
                'date' => now(),
                'total_amount' => 15000,
                'description' => 'Pembayaran listrik untuk mesin cuci dan pengering',
            ],
            // Perlengkapan Kantor
            [
                'category_id' => 4,
                'date' => now(),
                'total_amount' => 50000,
                'description' => 'Pembelian kertas dan tinta untuk mencetak tanda terima',
            ],
            // Promosi dan Pemasaran
            [
                'category_id' => 5,
                'date' => now(),
                'total_amount' => 1500000,
                'description' => 'Biaya iklan di media sosial',
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }
    }
}
