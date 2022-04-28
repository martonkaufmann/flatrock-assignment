<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionnaireSession extends Model
{
    public function guest(): BelongsTo
    {
        return $this->belongsTo(GuestUser::class);
    }

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function scopeOfGuestQuestionnaire(Builder $query, int $guestUserId, int $questionnareId): Builder
    {
        return $query
            ->where('guest_user_id', $guestUserId)
            ->where('questionnaire_id', $questionnareId)
        ;
    }
}
