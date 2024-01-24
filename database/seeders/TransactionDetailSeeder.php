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
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            for ($i = 0; $i < 3; $i++) {
                $priceList = PriceList::inRandomOrder()->first();
                $quantity = rand(1, 5);
                $price = $priceList->price;
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
