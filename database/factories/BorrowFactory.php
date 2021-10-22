<?php

namespace Database\Factories;

use App\Models\Borrow;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Borrow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'taken_date' => $this->faker->dateTime,
            'brought_date' => $this->faker->dateTime,
            'book_id' => \App\Models\Book::factory(),
            'student_id' => \App\Models\Student::factory(),
        ];
    }
}
