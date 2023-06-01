<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(rand(3, 7), true),
            'user_id' => \App\Models\User::pluck('id')->random(),
            'votes_count' => rand(0, 5),
        ];
    }
}
