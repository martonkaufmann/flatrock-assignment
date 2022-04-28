<?php

namespace Database\Seeders;

use App\Enums\QuestionnaireTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questionnaire_types')->insert([
            ['id' => QuestionnaireTypeEnum::SINGLE_CHOICE->value, 'name' => 'Single choice'],
            ['id' => QuestionnaireTypeEnum::MULTI_CHOICE->value, 'name' => 'Multi choice'],
            ['id' => QuestionnaireTypeEnum::BINARY_CHOICE->value, 'name' => 'Binary choice'],
        ]);
    }
}
