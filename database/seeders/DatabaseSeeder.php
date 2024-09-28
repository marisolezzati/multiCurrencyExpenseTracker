<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Currency;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Currency::factory()->create([
            'name' => 'dolar',
            'rate' => 1,
        ]);

        Currency::factory()->create([
            'name' => 'euro',
            'rate' => 1.1,
        ]);

        Currency::factory()->create([
            'name' => 'yen',
            'rate' => 1.1,
        ]);
    }
}
