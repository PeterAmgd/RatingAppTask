<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ClientSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // $this->call(SettingsSeeder::class);
        $this->call(ClientSeeder::class);
    }
}
