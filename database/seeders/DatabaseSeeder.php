<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(['email' => 'admin@mail.com']);

        $this->call([
            AnswerSeeder::class,
            QuestionnaireTypeSeeder::class,
            BinaryChoiceSeeder::class,
            SingleChoiceSeeder::class,
            MultiChoiceSeeder::class,
        ]);
    }
}
