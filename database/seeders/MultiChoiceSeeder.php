<?php

namespace Database\Seeders;

use App\Enums\QuestionnaireTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultiChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionnaireId = DB::table('questionnaires')->insertGetId(
            ['name' => 'Multi choice questionnaire 1', 'type_id' => QuestionnaireTypeEnum::MULTI_CHOICE->value]
        );

        for ($i = 0; $i < 10; ++$i) {
            $questionId = DB::table('questions')->insertGetId(
                ['questionnaire_id' => $questionnaireId, 'content' => "Question $i"]
            );

            DB::table('answer_question')->insert([
                [
                    'answer_id' => DB::table('answers')->insertGetId(['content' => 'Good answer']),
                    'question_id' => $questionId,
                    'is_correct' => true,
                ],
                [
                    'answer_id' => DB::table('answers')->insertGetId(['content' => 'Good answer']),
                    'question_id' => $questionId,
                    'is_correct' => true,
                ],
                [
                    'answer_id' => DB::table('answers')->insertGetId(['content' => 'Bad author']),
                    'question_id' => $questionId,
                    'is_correct' => false,
                ],
            ]);
        }
    }
}
