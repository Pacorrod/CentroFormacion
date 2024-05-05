<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'dni' => $this->faker->randomNumber(8,true),
            'cp' => $this->faker->randomNumber(4,true),
            'address' => $this->faker->sentence(12),
            'city' => $this->faker->city(),
            'province' =>$this->faker->city(),
            'phone'=>$this->faker->randomElement(['978848484','58657575757']),
            'email'=>$this->faker->randomElement(['pacorrod@hotmail.com','francisco@euromatsl.com']),
            'birthdate'=>$this->faker->date(),
            'disable' =>$this->faker->randomElement([0,1]),
            'removed'=>$this->faker->randomElement([0,1]),
        ];
    }
}
