<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const USERS_QNT = 10;

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < self::USERS_QNT; $i++) {
            $user = User::create([
                'subject_id' => Subject::notUsers()->inRandomOrder()->pluck('id')->first(),
                'password'   => bcrypt($faker->password())
            ]);
            $user->roles()->attach(Role::whereNotIn('title', [Role::ROLE_BOT, Role::ROLE_ADMIN])->inRandomOrder()->first());
        }
    }
}
