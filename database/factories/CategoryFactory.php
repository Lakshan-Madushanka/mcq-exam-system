<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

        ];
    }

    public function categorySequence()
    {
        return $this->state(new Sequence(
                ['name' => 'php'],
                ['name' => 'mysql'],
                ['name' => 'laravel'],
                ['name' => 'mixed'],
            )
        );
    }
}
