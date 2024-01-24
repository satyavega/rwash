<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@laundryxyz.com',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Laundry',
                'role' => Role::Admin->value,
            ],
            [
                'email' => 'sain@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Sain Hansen',
                'role' => Role::Member->value,
                'gender' => 'laki-laki',
                'address' => 'Tokyo Shibuya',
                'phone_number' => '022122833',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'hina@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Hina Hatsumi',
                'role' => Role::Member->value,
                'gender' => 'perempuan',
                'address' => 'Tokyo Saitama',
                'phone_number' => '022122833',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'sen@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Sen Honoka',
                'role' => Role::Member->value,
                'gender' => 'perempuan',
                'address' => 'Shinjuku',
                'phone_number' => '0899219128',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'kotori@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Kotori Hima',
                'role' => Role::Member->value,
                'gender' => 'perempuan',
                'address' => 'Saitama',
                'phone_number' => '022122833',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'natsume@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Natsume Kana',
                'role' => Role::Member->value,
                'gender' => 'perempuan',
                'address' => 'Harajuku',
                'phone_number' => '012122833',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'yuki@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Yuki Kato',
                'role' => Role::Member->value,
                'gender' => 'laki-laki',
                'address' => 'Shibuya',
                'phone_number' => '02431833',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'ai@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Ai Mai',
                'role' => Role::Member->value,
                'gender' => 'perempuan',
                'address' => 'Shibuya',
                'phone_number' => '0891231313',
                'point' => rand(0, 100),
            ],
            [
                'email' => 'chuya@gmail.com',
                'password' => Hash::make('12345678'),
                'name' => 'Chuya Mito',
                'role' => Role::Member->value,
                'gender' => 'laki-laki',
                'address' => 'Saitama',
                'phone_number' => '0881231231',
                'point' => rand(0, 100),
            ],
        ];

        foreach ($users as $userData) {
            $user = new User($userData);
            $user->save();
        }
    }
}
