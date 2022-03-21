<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\UserQuestionnaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
           AnswerSeeder::class,
        ]);

        $this->assignUsersQuestionnaires();
        $this->assignAnswersForQuestions();
        $this->assignQuestionsForQuestionnaires();
        $this->assignEvaluationsForUsersQuestionnaires();
    }

    private function assignEvaluationsForUsersQuestionnaires()
    {
        $userQuestionnaires = UserQuestionnaire::whereStatus(User::QUESTIONNAIRE_STATUS['finished'])->get();

        $userQuestionnaires->each(function (UserQuestionnaire $uq) {
            $questionnaire = Questionnaire::find($uq->questionnaire_id);

            $noOfAnswers = mt_rand($questionnaire->min_question, $questionnaire->max_question);
            $questions = $questionnaire->questions()->limit($noOfAnswers)->get();

            $timeTaken = $questionnaire->allocated_time;
            $marks = mt_rand(0, 100);

            $answers = [];

            $questions->each(function (Question $q) use (&$answers) {
                $answers[(string) $q->id] = array_rand($q->answers()->pluck('id')->all());
            });

            $jsonAnswers = json_encode($answers);

            $eval = Evaluation::factory()->make([
                'no_of_answered_question' => $noOfAnswers,
                'time_taken'              => $timeTaken,
                'answers'                 => $jsonAnswers,
            ]);

            $uq->evaluation()->save($eval);
        });
    }

    private function assignQuestionsForQuestionnaires()
    {
        $questionnaires = Questionnaire::with('category')->get();

        $questionnaires->each(function (Questionnaire $questionnaire) {
            $noOfQuestions = mt_rand($questionnaire->min_question, $questionnaire->max_question);

            $allQuestions = Question::where('category_id', $questionnaire->category->id)
                ->limit($noOfQuestions)
                ->pluck('id')->all();

            $questions = $questionnaire->questions()->attach($allQuestions);
        });
    }

    private function assignUsersQuestionnaires()
    {
        $questionnaires = Questionnaire::inRandomOrder()->limit(10)->get();

        $questionnaires->each(function (Questionnaire $q, int $index) {
            $userIds = User::inRandomOrder()->limit(mt_rand(1, 5))->pluck('id')->all();

            $id = $index % count(User::QUESTIONNAIRE_STATUS);
            $q->users()->syncWithPivotValues($userIds, ['status' => $id]);
        });
    }

    private function assignAnswersForQuestions()
    {
        Question::all()->each(function (Question $q) {
            $noOfAnswers = $q->no_of_answer;
            $answersIds = Answer::inRandomOrder()->limit($noOfAnswers)->pluck('id')->all();

            $offset = mt_rand(0, count($answersIds) - 1);
            $correctAnswer = array_slice($answersIds, $offset, 1);

            $q->answers()->attach($correctAnswer, ['correct_answer' => true]);
            $q->answers()->attach($answersIds);
        });
    }
}
