<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\PriceList;

class TransactionDetailSeeder extends Seeder
{
        public function run()
    {
        // Ambil semua transaksi yang ada
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            // Jumlah detail per transaksi, misalnya 3
            for ($i = 0; $i < 3; $i++) {
                // Pilih price list secara acak
                $priceList = PriceList::inRandomOrder()->first();
                $quantity = rand(1, 5); // Contoh kuantitas acak
                $price = $priceList->price; // Asumsi setiap price list memiliki field harga
                $subTotal = $quantity * $price;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'price_list_id' => $priceList->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'sub_total' => $subTotal
                ]);
            }
        }
    }
}
