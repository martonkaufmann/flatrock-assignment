<?php

namespace Database\Seeders;

use App\Enums\QuestionnaireTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SingleChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            'Albert Einstein' => 'I have no special talent. I am only passionately curious.',
            'William Shakespeare' => 'Wisely, and slow. They stumble that run fast.',
            'Mother Teresa' => 'If you judge people, you have no time to love them.',
            'Mark Twain' => 'I have no special talent. I am only passionately curious.',
            'Buddha' => 'All that we are is the result of what we have thought.',
            'Coco Chanel' => 'The most courageous act is still to think for yourself. Aloud.',
            'Steve Jobs' => 'Stay hungry, stay foolish',
            'Albert Einstein' => 'Insanity: doing the same thing over and over again and expecting different results.',
            'Plato' => 'The greatest wealth is to live content with little.',
            'Malcolm X' => 'The future belongs to those who prepare for it today.',
        ];

        $questionnaireId = DB::table('questionnaires')->insertGetId(
            ['name' => 'Single choice questionnaire 1', 'type_id' => QuestionnaireTypeEnum::SINGLE_CHOICE->value]
        );

        foreach ($quotes as $author => $quote) {
            $questionId = DB::table('questions')->insertGetId(
                ['questionnaire_id' => $questionnaireId, 'content' => $quote]
            );

            DB::table('answer_question')->insert([
                [
                    'answer_id' => DB::table('answers')->insertGetId(['content' => $author]),
                    'question_id' => $questionId,
                    'is_correct' => true,
                ],
                [
                    'answer_id' => DB::table('answers')->insertGetId(['content' => 'Bad author']),
                    'question_id' => $questionId,
                    'is_correct' => false,
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
