<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Service;


class PriceListSeeder extends Seeder
{
    public function run()
    {
        $prices = [
            ['name' => 'Alas Meja S', 'prices' => [['category' => 'Satuan', 'price' => 10000]]],
            ['name' => 'Alas Meja M', 'prices' => [['category' => 'Satuan', 'price' => 14000]]],
            ['name' => 'Alas Meja L', 'prices' => [['category' => 'Satuan', 'price' => 18000]]],
            ['name' => 'Baju', 'prices' => [['category' => 'Satuan', 'price' => 5000], ['category' => 'Kiloan', 'price' => 12000]]],
            ['name' => 'Bed Cover Single', 'prices' => [['category' => 'Satuan', 'price' => 20000]]],
            ['name' => 'Bed Cover Double', 'prices' => [['category' => 'Satuan', 'price' => 30000]]],
            ['name' => 'Boneka S', 'prices' => [['category' => 'Satuan', 'price' => 18000]]],
            ['name' => 'Boneka M', 'prices' => [['category' => 'Satuan', 'price' => 24000]]],
            ['name' => 'Boneka L', 'prices' => [['category' => 'Satuan', 'price' => 30000]]],
            ['name' => 'Celana', 'prices' => [['category' => 'Satuan', 'price' => 7000], ['category' => 'Kiloan', 'price' => 15000]]],
            ['name' => 'Cover Sofa', 'prices' => [['category' => 'Satuan', 'price' => 30000]]],
            ['name' => 'Gamis', 'prices' => [['category' => 'Satuan', 'price' => 20000]]],
            ['name' => 'Gorden', 'prices' => [['category' => 'Satuan', 'price' => 25000]]],
            ['name' => 'Handuk', 'prices' => [['category' => 'Satuan', 'price' => 6000], ['category' => 'Kiloan', 'price' => 12000]]],
            ['name' => 'Jaket', 'prices' => [['category' => 'Satuan', 'price' => 15000]]],
            ['name' => 'Jas', 'prices' => [['category' => 'Satuan', 'price' => 17000]]],
            ['name' => 'Jas Setelan', 'prices' => [['category' => 'Satuan', 'price' => 25000]]],
            ['name' => 'Karpet S', 'prices' => [['category' => 'Satuan', 'price' => 15000]]],
            ['name' => 'Karpet M', 'prices' => [['category' => 'Satuan', 'price' => 18000]]],
            ['name' => 'Karpet L', 'prices' => [['category' => 'Satuan', 'price' => 21000]]],
            ['name' => 'Pakaian Dalam', 'prices' => [['category' => 'Kiloan', 'price' => 7000]]],
            ['name' => 'Rok Pendek', 'prices' => [['category' => 'Satuan', 'price' => 10000]]],
            ['name' => 'Rok Panjang', 'prices' => [['category' => 'Satuan', 'price' => 14000]]],
            ['name' => 'Sarung Bantal', 'prices' => [['category' => 'Satuan', 'price' => 5000], ['category' => 'Kiloan', 'price' => 10000]]],
            ['name' => 'Sarung Guling', 'prices' => [['category' => 'Satuan', 'price' => 6500], ['category' => 'Kiloan', 'price' => 13000]]],
            ['name' => 'Selimut S', 'prices' => [['category' => 'Satuan', 'price' => 25000]]],
            ['name' => 'Selimut M', 'prices' => [['category' => 'Satuan', 'price' => 30000]]],
            ['name' => 'Selimut L', 'prices' => [['category' => 'Satuan', 'price' => 35000]]],
            ['name' => 'Sprei Single', 'prices' => [['category' => 'Satuan', 'price' => 15000]]],
            ['name' => 'Sprei Double', 'prices' => [['category' => 'Satuan', 'price' => 20000]]],
            ['name' => 'Tas S', 'prices' => [['category' => 'Satuan', 'price' => 20000]]],
            ['name' => 'Tas M', 'prices' => [['category' => 'Satuan', 'price' => 30000]]],
            ['name' => 'Tas L', 'prices' => [['category' => 'Satuan', 'price' => 40000]]],
            ['name' => 'Tas Travel', 'prices' => [['category' => 'Satuan', 'price' => 60000]]],
        ];
        $serviceAdjustments = [
            'Setrika' => 2000,
            'Cuci + Lipat' => 4000,
            'Cuci + Setrika' => 6000,
            'Cuci' => 0, // Tidak ada penambahan harga untuk Cuci
        ];

        foreach ($prices as $itemData) {
            $item = Item::where('name', $itemData['name'])->first();
            if (!$item) continue;

            foreach ($itemData['prices'] as $priceData) {
                $category = Category::where('name', $priceData['category'])->first();
                if (!$category) continue;

                foreach ($serviceAdjustments as $serviceName => $adjustment) {
                    $service = Service::where('name', $serviceName)->first();
                    if (!$service) continue;

                    PriceList::create([
                        'item_id' => $item->id,
                        'category_id' => $category->id,
                        'service_id' => $service->id,
                        'price' => $priceData['price'] + $adjustment
                    ]);
                }
            }
        }
    }
}
