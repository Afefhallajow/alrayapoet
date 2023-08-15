<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegisteredFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'email'=>$this->faker->email,
            'gender'=>$this->faker->name,
            'age'=>$this->faker->numberBetween(1,5),
            'nationality'=>$this->faker->text,
            'city'=>$this->faker->text,
            'mobile'=>$this->faker->phoneNumber,
            'season'=>2,


        ];
    }
}
