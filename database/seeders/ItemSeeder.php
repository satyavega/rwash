<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            ['name' => 'Alas Meja S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alas Meja M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alas Meja L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Baju', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bed Cover Single', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bed Cover Double', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Boneka S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Boneka L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Boneka M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cover Sofa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gamis', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gorden', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Handuk', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jas Setelan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Karpet S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Karpet M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Karpet L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pakaian Dalam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Pendek', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Panjang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarung Bantal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarung Guling', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Selimut S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Selimut M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Selimut L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sprei Single', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sprei Double', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tas S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tas M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tas L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tas Travel', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
