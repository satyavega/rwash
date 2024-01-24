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
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 6,
                'created_at' => Carbon::now()->subDays(60),
                'updated_at' => Carbon::now()->subDays(60)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 7,
                'created_at' => Carbon::now()->subDays(60),
                'updated_at' => Carbon::now()->subDays(60)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 9,
                'created_at' => Carbon::now()->subDays(50),
                'updated_at' => Carbon::now()->subDays(50)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 8,
                'created_at' => Carbon::now()->subDays(32),
                'updated_at' => Carbon::now()->subDays(32)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 7,
                'created_at' => Carbon::now()->subDays(32),
                'updated_at' => Carbon::now()->subDays(32)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 4,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 2,
                'created_at' => Carbon::now()->subDays(29),
                'updated_at' => Carbon::now()->subDays(29)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 5,
                'created_at' => Carbon::now()->subDays(26),
                'updated_at' => Carbon::now()->subDays(26)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 4,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 5,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 2,
                'created_at' => Carbon::now()->subDays(21),
                'updated_at' => Carbon::now()->subDays(21)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 3,
                'created_at' => Carbon::now()->subDays(22),
                'updated_at' => Carbon::now()->subDays(22)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 6,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 6,
                'created_at' => Carbon::now()->subDays(16),
                'updated_at' => Carbon::now()->subDays(16)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 7,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 2,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 8,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 9,
                'created_at' => Carbon::now()->subDays(13),
                'updated_at' => Carbon::now()->subDays(13)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 5,
                'created_at' => Carbon::now()->subDays(13),
                'updated_at' => Carbon::now()->subDays(13)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 7,
                'created_at' => Carbon::now()->subDays(11),
                'updated_at' => Carbon::now()->subDays(11)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 6,
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 3,
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9)
            ],
            [
                'status_id' => 3,
                'admin_id' => 1,
                'member_id' => 4,
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(6)
            ],
            [
                'status_id' => 2,
                'admin_id' => 1,
                'member_id' => 2,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'status_id' => 2,
                'admin_id' => 1,
                'member_id' => 3,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 8,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'status_id' => 1,
                'admin_id' => 1,
                'member_id' => 9,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
        ];

        foreach ($transactions as &$data) {
            $totalItemPrice = 0;

            $numberOfItemsToAdd = rand(1, 5);
            $itemIds = Item::inRandomOrder()->take($numberOfItemsToAdd)->get();

            foreach ($itemIds as $item) {
                $quantity = rand(1, 5);
                $itemPrice = PriceList::where('item_id', $item->id)->first()->price ?? 0;
                $totalItemPrice += $itemPrice * $quantity;
            }

            $serviceType = ServiceType::inRandomOrder()->first();
            $servicePrice = $serviceType ? $serviceType->price : 0;

            $total = $totalItemPrice + $servicePrice;

            $data['total'] = $total;
            $data['service_type_id'] = $serviceType->id;

            $transaction = Transaction::create($data);

            foreach ($itemIds as $item) {
                $quantity = rand(1, 5);
                ItemTransaction::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id,
                    'quantity' => $quantity
                ]);
            }
        }
    }
}
