<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(Answer::class)->withPivot('is_correct');
    }

    public function correctAnswers(): BelongsToMany
    {
        return $this->belongsToMany(Answer::class)->wherePivot('is_correct', true);
    }
}
