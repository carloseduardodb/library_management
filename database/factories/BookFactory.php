<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'pagecount' => $this->faker->randomNumber(0),
            'category' => $this->faker->randomNumber(0),
            'authors' => $this->faker->randomNumber(0),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
