<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitAnswerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // TODO: Check why not triggered
        return [
            'answers' => 'sometimes|required|array',
            'answers.*' => [
                'required',
                'numeric',
                Rule::in(
                    $this->question->answers->pluck('id')->toArray()
                ),
            ],
        ];
    }
}
