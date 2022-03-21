<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentences(mt_rand(1,3), true),
            'image' => $this->faker->imageUrl(),
            'no_of_answer' => $this->faker->randomElement([2,4])
        ];
    }

    public function difficultySequence()
    {
        return $this->state(new Sequence(
                ['difficulty' => Question::DIFFICULTY['easy']],
                ['difficulty' => Question::DIFFICULTY['medium']],
                ['difficulty' => Question::DIFFICULTY['hard']],
            )
        );
    }
}
