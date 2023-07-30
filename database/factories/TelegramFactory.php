<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telegram>
 */
class TelegramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subject_ids = Subject::pluck('id')->all();

        return [
            'subject_id' => $this->faker->unique()->randomElement($subject_ids),
            'account'    => $this->faker->unique()->numberBetween(100000000, 1500000000)
        ];
    }
}
