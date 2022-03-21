<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Questionnaire;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QuestionnaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'                     => Str::random(5),
            'min_question'             => $this->faker->randomElement([25, 50]),
            'max_question'             => $this->faker->randomElement([50, 75, 100]),
            'allocated_time'           => $this->faker->randomElement([
                Carbon::createFromTime(2, 0, 0)->toTimeString(),
                Carbon::createFromTime(0, 30, 0)->toTimeString(),
                Carbon::createFromTime(1, 30, 0)->toTimeString(),
                Carbon::createFromTime(3, 0, 0)->toTimeString(),
            ]),
            'min_answers_per_question' => 2,
            'max_answers_per_question' => $this->faker->randomElement([2, 4]),
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
