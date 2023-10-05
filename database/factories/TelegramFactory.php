<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Telegram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Telegram>
 */
class TelegramFactory extends Factory
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
            'account'    => $this->faker->unique()->numberBetween(100000000, 1500000000)
        ];
    }
}
