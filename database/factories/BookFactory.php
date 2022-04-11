<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->text(100),
            'text' => $this->faker->text(500),
            'description' => $this->faker->text(),
            'pages' => $this->faker->numberBetween(1, 2500),
            'votes' => $this->faker->numberBetween(1, 1500),
        ];
    }
}
