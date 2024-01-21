<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\Status;
use App\Models\ServiceType;
use App\Models\PriceList;
use Carbon\Carbon;


class TransactionSeeder extends Seeder
{
    public function run()
    {
        $transactions = [
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 2,
                'discount' => 0,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 3,
                'discount' => 5000,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 4,
                'discount' => 5000,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 5,
                'discount' => 0,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 6,
                'discount' => 10000,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4)
            ],
        ];

        foreach ($transactions as &$data) {
            $totalItemPrice = 0;

            // Menentukan jumlah item yang akan ditambahkan
            $numberOfItemsToAdd = rand(1, 5);

            // Mendapatkan ID item secara acak dari database dan menghitung total harga item
            $itemIds = Item::inRandomOrder()->take($numberOfItemsToAdd)->get();
            foreach ($itemIds as $item) {
                $quantity = rand(1, 10);
                $itemPrice = PriceList::where('item_id', $item->id)->first()->price ?? 0;
                $totalItemPrice += $itemPrice * $quantity;
            }

            // Ambil harga layanan dari tabel 'service'
            $serviceType = ServiceType::inRandomOrder()->first();
            $servicePrice = $serviceType ? $serviceType->price : 0;

            // Hitung total sebelum diskon
            $totalBeforeDiscount = $totalItemPrice + $servicePrice;

            // Terapkan diskon
            $discount = $data['discount'] ?? 0;
            $totalAfterDiscount = $totalBeforeDiscount - $discount;

            // Tambahkan total dan service_type_id ke data transaksi
            $data['total'] = $totalAfterDiscount;
            $data['service_type_id'] = $serviceType->id;

            // Buat transaksi dengan semua data yang diperlukan
            $transaction = Transaction::create($data);

            // Tambahkan item ke transaksi
            foreach ($itemIds as $item) {
                $quantity = rand(1, 10);
                ItemTransaction::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id,
                    'quantity' => $quantity
                ]);
            }
        }
    }
}
