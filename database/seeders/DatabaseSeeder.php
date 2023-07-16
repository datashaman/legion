<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::updateOrCreate([
            'email' => 'marlinf@example.com',
        ], [
            'name' => 'Marlin Forbes',
            'password' => Hash::make('password'),
        ]);
    }
}
