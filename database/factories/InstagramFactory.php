<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Instagram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instagram>
 */
class InstagramFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subject_ids = Subject::notUsers()->pluck('id');

        return [
            'subject_id' => $this->faker->unique()->randomElement($subject_ids),
            'account'    => $this->faker->unique()->userName
        ];
    }
}
