<?php

namespace Database\Seeders;

use App\Models\Instagram;
use Illuminate\Database\Seeder;

class InstagramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instagram::factory(50)->create();
    }
}
