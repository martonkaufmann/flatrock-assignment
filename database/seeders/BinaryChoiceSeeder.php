<?php

namespace Database\Seeders;

use App\Enums\AnswerEnum;
use App\Enums\QuestionnaireTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BinaryChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionnaireId = DB::table('questionnaires')->insertGetId(
            ['name' => 'Binary choice questionnaire 1', 'type_id' => QuestionnaireTypeEnum::BINARY_CHOICE->value]
        );

        for ($i = 0; $i < 10; ++$i) {
            $questionId = DB::table('questions')->insertGetId(
                ['questionnaire_id' => $questionnaireId, 'content' => "Question $i"]
            );

            DB::table('answer_question')->insert([
                [
                    'answer_id' => AnswerEnum::YES->value,
                    'question_id' => $questionId,
                    'is_correct' => true,
                ],
                [
                    'answer_id' => AnswerEnum::NO->value,
                    'question_id' => $questionId,
                    'is_correct' => false,
                ],
            ]);
        }
    }
}
