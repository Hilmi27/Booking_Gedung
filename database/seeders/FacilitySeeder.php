<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Sound System',
                'description' => 'Sistem audio berkualitas tinggi dengan speaker dan mikrofon',
                'icon' => 'fa-volume-up',
            ],
            [
                'name' => 'Lighting System',
                'description' => 'Sistem pencahayaan panggung lengkap dengan berbagai efek',
                'icon' => 'fa-lightbulb',
            ],
            [
                'name' => 'Proyektor',
                'description' => 'Proyektor HD dengan layar lebar',
                'icon' => 'fa-projector',
            ],
            [
                'name' => 'Kursi Penonton',
                'description' => 'Kursi nyaman untuk penonton',
                'icon' => 'fa-chair',
            ],
            [
                'name' => 'Ruang Ganti',
                'description' => 'Ruang ganti untuk persiapan pemain',
                'icon' => 'fa-door-closed',
            ],
            [
                'name' => 'AC',
                'description' => 'Pendingin ruangan untuk kenyamanan',
                'icon' => 'fa-snowflake',
            ],
            [
                'name' => 'Panggung',
                'description' => 'Panggung dengan berbagai ukuran',
                'icon' => 'fa-stage',
            ],
            [
                'name' => 'Backdrop',
                'description' => 'Latar belakang panggung yang dapat disesuaikan',
                'icon' => 'fa-image',
            ],
            [
                'name' => 'WiFi',
                'description' => 'Koneksi internet nirkabel berkecepatan tinggi',
                'icon' => 'fa-wifi',
            ],
            [
                'name' => 'Parkir',
                'description' => 'Area parkir luas untuk kendaraan',
                'icon' => 'fa-parking',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}