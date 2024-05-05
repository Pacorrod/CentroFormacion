<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'name' => $this->faker->name(),
            'startdate' => $this->faker->date(),
            'enddate' => $this->faker->date(),
            'hours' => $this->faker->numberBetween(20, 500),
            'nstudents' => $this->faker->numberBetween(1, 25),
            'expedient' =>$this->faker->randomElement(['11','22']),
            'certificatecode'=>$this->faker->randomElement(['11','22']),
            'comments'=>$this->faker->randomElement(['aa','bb']),
            'CoursesTypeEnum'=>$this->faker->randomElement(['encurso','preparando']),
            'CoursesModoEnum' =>$this->faker->randomElement(['teleformacion','bimodal']),
            'CoursesClassEnum'=>$this->faker->randomElement(['desempleados','ocupados']),
            'picture'=>"pictures/01HX26FCDFRRH4WT8CAYGSD59K.jpg",
            'schedule'=>"16:00h - 20:00h",

        ];
    }
}
