<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    public function type(): BelongsTo
    {
        return $this->belongsTo(QuestionnaireType::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
