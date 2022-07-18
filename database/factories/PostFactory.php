<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{

    public function definition()
    {
        return [
            'title'         => $this->faker->sentence(5),
            'description'   => $this->faker->sentence(20),
            'image'         => $this->faker->uuid().'.jpg',
            'user_id'       => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9])
        ];
    }
}
