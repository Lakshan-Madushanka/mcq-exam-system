<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(4)->categorySequence()
            ->has(Question::factory(100)
                ->difficultySequence()
            )->has(Questionnaire::factory(4)
                ->difficultySequence()
            )->create();
    }
}
