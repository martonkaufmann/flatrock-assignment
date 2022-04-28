<?php

namespace App\Http\Requests\Admin;

use App\Enums\AnswerEnum;
use App\Enums\QuestionnaireTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuestionnaireRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:5|max:64',
            'questions' => 'required|array|size:2',
            'questions.*.content' => 'required|string|min:5|max:255',
        ];

        return match ($this->questionnaireType->id) {
            QuestionnaireTypeEnum::MULTI_CHOICE->value => $rules + [
                'questions.*.answers' => 'required|array|size:3',
                'questions.*.answers.*.content' => 'required|string|min:5|max:255',
                'questions.*.answers.*.is_correct' => 'boolean',
            ],
            QuestionnaireTypeEnum::SINGLE_CHOICE->value => $rules + [
                'questions.*.correct_anwer' => 'required|numeric|min:0|max:2',
                'questions.*.answers' => 'required|array|size:3',
                'questions.*.answers.*.content' => 'required|string|min:5|max:255',
            ],
            QuestionnaireTypeEnum::BINARY_CHOICE->value => $rules + [
                'questions.*.correct_anwer' => [
                    'required', 'numeric', Rule::in([
                        AnswerEnum::YES->value,
                        AnswerEnum::NO->value,
                    ]),
                ],
            ],
        };
    }
}
