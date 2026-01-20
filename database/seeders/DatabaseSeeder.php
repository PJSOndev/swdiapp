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
    }
}

