<?php

namespace Database\Seeders;

use App\Models\Telegram;
use Illuminate\Database\Seeder;

class TelegramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        Telegram::factory(20)->create();
    }
}
