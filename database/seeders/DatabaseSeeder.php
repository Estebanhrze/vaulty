<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 👇 Esta línea le dice a Laravel que ejecute DemoSeeder también
        $this->call([
            DemoSeeder::class,
        ]);
    }
}
