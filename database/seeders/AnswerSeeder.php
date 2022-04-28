<?php

namespace Database\Seeders;

use App\Enums\AnswerEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('answers')->insert([
            ['id' => AnswerEnum::YES->value, 'content' => 'Yes'],
            ['id' => AnswerEnum::NO->value, 'content' => 'No'],
        ]);
    }
}
