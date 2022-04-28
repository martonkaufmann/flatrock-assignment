<?php

namespace App\Http\Controllers\Admin;

use App\Enums\QuestionnaireTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionnaireRequest;
use App\Models\Questionnaire;
use App\Models\QuestionnaireType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{
    public function index(): View
    {
        return view('admin.questionnaire.index', [
            'questionnaires' => Questionnaire::with('type')->get(),
            'questionnaireTypes' => QuestionnaireType::all(),
        ]);
    }

    public function create(Request $request, QuestionnaireType $questionnaireType): View
    {
        return view(
            'admin.questionnaire.create',
            [
                'questionnaireType' => $questionnaireType,
                'questionnaireTypeTemplate' => match ($questionnaireType->id) {
                    QuestionnaireTypeEnum::SINGLE_CHOICE->value => 'admin.questionnaire.single-choice',
                    QuestionnaireTypeEnum::MULTI_CHOICE->value => 'admin.questionnaire.multi-choice',
                    QuestionnaireTypeEnum::BINARY_CHOICE->value => 'admin.questionnaire.binary-choice',
                },
            ],
        );
    }

    public function store(StoreQuestionnaireRequest $request, QuestionnaireType $questionnaireType): RedirectResponse
    {
        $questionnaire = new Questionnaire();
        $questionnaire->type_id = $questionnaireType->id;
        $questionnaire->name = $request->name;
        $questionnaire->save();

        // TODO: Implement saving

        return redirect()->route('admin.questionnaires.index');
    }

    public function show(Questionnaire $questionnaire): View
    {
        $topScores = $questionnaire
            ->scores()
            ->with('guest')
            ->orderBy('score', 'desc')
            ->orderBy('duration', 'asc')
            ->limit(10)
            ->get()
        ;

        return view('admin.questionnaire.show', [
            'topScores' => $topScores,
        ]);
    }
}
