<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => Hash::make('secret'),
        ]);

        // Call AssetSeeder
        $this->call(AssetSeeder::class);
        $this->call(Barangayb2Seeder::class);
        $this->call(Barangayb3Seeder::class);
        $this->call(Barangayb4Seeder::class);
        $this->call(Barangayb5Seeder::class);
        $this->call(BarangaysSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(IncomeSeeder::class);
    }
}

