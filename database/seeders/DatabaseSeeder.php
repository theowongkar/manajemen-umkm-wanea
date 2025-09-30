<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UrbanVillage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 admin default 
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@wanea.com',
            'role' => 'Admin',
        ]);

        // Isi kelurahan
        $urbanVillages = [
            'Bumi Nyiur',
            'Karombasan Selatan',
            'Karombasan Utara',
            'Pakowa',
            'Ranotana Weru',
            'Tanjung Batu',
            'Teling Atas',
            'Tingkulu',
            'Wanea',
        ];
        foreach ($urbanVillages as $urbanVillage) {
            UrbanVillage::create([
                'name' => $urbanVillage,
                'slug' => Str::slug($urbanVillage),
            ]);
        }
    }
}
