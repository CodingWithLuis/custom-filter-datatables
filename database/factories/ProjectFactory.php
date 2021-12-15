<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'start_date' => $this->faker->dateTimeBetween('2021-01-01', '2021-06-30'),
            'end_date' => $this->faker->dateTimeBetween('2021-07-01', '2021-12-31'),
            'user_id' => rand(1, 10),
            'status_id' => rand(1, 3)
        ];
    }
}
