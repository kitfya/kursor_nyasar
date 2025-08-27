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
            'name' => 'MUHAMMAD BANGKIT SANJAYA',
            'email' => 'bangkitsann28@gmail.com',
            'password' => 'bangkit99',
            'role' => 'fullstack',
        ]);

        User::factory()->create([
            'name' => 'MUHAMMAD AN NADHIF AL ISYARAFI',
            'email' => 'nadhif@gmail.com',
            'password' => 'nadhif123',
            'role' => 'backend',
        ]);

        User::factory()->create([
            'name' => 'DAVI PUTRA RACHMANDARI ',
            'email' => 'davi@gmail.com',
            'password' => 'davi123',
            'role' => 'frontend',
        ]);
    }
}
