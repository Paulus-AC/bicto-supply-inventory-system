<?php

namespace Database\Seeders;

use App\Models\User;
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
            'employee_id' => '51085',
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'SuperAdmin123',
            'role' => 1,
        ]);

        $this->call([
            CategorySeeder::class,
            UnitSeeder::class,
        ]);
    }
}
