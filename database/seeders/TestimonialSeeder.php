<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComplaintSuggestion;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complaintSuggestions = [
            [
                'body' => 'Pelayanan laundry sangat cepat dan hasilnya sangat memuaskan. Sangat direkomendasikan!',
                'type' => '2',
                'user_id' => 7,
            ],
            [
                'body' => 'Saya merasa harga yang ditawarkan sangat mahal untuk kualitas layanan yang diberikan.',
                'type' => '1',
                'user_id' => 2,
            ],
            [
                'body' => 'Terima kasih atas tanggapan cepat dari pihak laundry terkait keluhan saya sebelumnya.',
                'type' => '2',
                'user_id' => 3,
            ],
            [
                'body' => 'Pelayanan laundry Anda sangat memuaskan! Pakaian saya bersih dan wangi setelah dicuci. Sangat direkomendasikan!',
                'type' => '2',
                'user_id' => 5,
            ],
            [
                'body' => 'Harga laundry Anda sangat terjangkau dan hasilnya memuaskan. Terima kasih atas layanan yang baik!',
                'type' => '2',
                'user_id' => 4,
            ],
        ];

        foreach ($complaintSuggestions as $complaintSuggestion) {
            ComplaintSuggestion::create($complaintSuggestion);
        }
    }
}
