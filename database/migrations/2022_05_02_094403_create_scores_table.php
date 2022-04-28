<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_user_id')->constrained();
            $table->foreignId('questionnaire_id')->constrained();
            $table->tinyInteger('score');
            $table->smallInteger('duration');
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
            $table->index(['score', 'duration']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
