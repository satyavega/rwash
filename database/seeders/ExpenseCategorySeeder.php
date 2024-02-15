<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;


class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Bahan Kimia dan Pembersih',
            'Perlengkapan Laundry',
            'Utilitas dan Perawatan',
            'Perlengkapan Kantor',
            'Promosi dan Pemasaran',
        ];

        foreach ($categories as $category) {
            ExpenseCategory::create(['name' => $category]);
        }
    }
}
