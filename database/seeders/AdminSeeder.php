<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Phone;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    const PHONES = [
        '+380678708032',
        '+380957568510'
    ];

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $subject = Subject::create([
            'first_name' => 'Константин',
            'last_name'  => 'Аржанов'
        ]);

        foreach (self::PHONES as $phone) {
            Phone::create([
                'subject_id' => $subject->id,
                'phone'      => $phone
            ]);
        }

        $user = User::create([
            'subject_id' => $subject->id,
            'password'   => bcrypt('1111')
        ]);

        $user->roles()->attach(Role::where('title', Role::ROLE_ADMIN)->first());
    }
}
