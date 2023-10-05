<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject_id' => Subject::notUsers()->inRandomOrder()->pluck('id')->first(),
            'password'   => bcrypt($this->faker->password())
        ];
    }
}
