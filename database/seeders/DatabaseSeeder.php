<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user untuk testing
        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => 'password',
        ]);

        // Dummy users
        User::factory(5)->create();

        // Dummy 10 Produk
        $this->call(ProductSeeder::class);
    }
}
