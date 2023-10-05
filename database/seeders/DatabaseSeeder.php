<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            SubjectSeeder::class,
            PhoneSeeder::class,
            InstagramSeeder::class,
            TelegramSeeder::class,
            UserSeeder::class,
        ]);
    }
}
