<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionnaireType extends Model
{
    public $timestamps = false;

    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class, 'type_id');
    }
}
