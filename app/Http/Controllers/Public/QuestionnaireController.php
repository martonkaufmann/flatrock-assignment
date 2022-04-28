<?php

namespace App\Http\Controllers\Public;

use App\Enums\QuestionnaireTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\SubmitAnswerRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionnaireSession;
use App\Models\QuestionnaireType;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{
    public function typeList(): View
    {
        return view('public.questionnaire.type-list', [
            'questionnaireTypes' => QuestionnaireType::all(),
        ]);
    }

    public function list(QuestionnaireType $questionnaireType): View
    {
        return view('public.questionnaire.list', [
            'questionnaires' => $questionnaireType->questionnaires,
        ]);
    }

    public function start(Questionnaire $questionnaire): View|RedirectResponse
    {
        $session = QuestionnaireSession::where('guest_user_id', session('guest'))->first();

        if ($session) {
            if ($session->created_at->diffInMinutes(now()) >= 1) {
                return view('public.questionnaire.start', [
                    'oldQuestionnaire' => $session->questionnaire,
                    'newQuestionnaire' => $questionnaire,
                ]);
            }

            $session->delete();
        }

        session(['score' => 0]);
        $session = new QuestionnaireSession();
        $session->questionnaire_id = $questionnaire->id;
        $session->guest_user_id = session('guest');
        $session->save();

        return redirect()->route('questionnaires.question', ['questionnaire' => $questionnaire->id]);
    }

    public function cancel(Questionnaire $questionnaire): RedirectResponse
    {
        QuestionnaireSession::query()
            ->where('guest_user_id', session('guest'))
            ->delete()
        ;

        return redirect()->route('questionnaires.start', ['questionnaire' => $questionnaire->id]);
    }

    public function nextQuestion(Questionnaire $questionnaire): View|RedirectResponse
    {
        $session = QuestionnaireSession::ofGuestQuestionnaire(session('guest'), $questionnaire->id)->first();
        $questions = $questionnaire->questions();

        if (null === $session->question_id) {
            $question = $questions->latest()->first();
        } else {
            $question = $questions->where('id', '>', $session->question_id)->first();
        }

        if (null === $question) {
            $score = new Score();
            $score->score = session('score');
            $score->duration = now()->diffInSeconds($session->created_at);
            $score->guest_user_id = session('guest');
            $score->questionnaire_id = $questionnaire->id;
            $score->save();

            $session->delete();

            return redirect()->route('questionnaires.score', ['score' => $score]);
        }

        $session->question_id = $question->id;
        $session->save();

        return view('public.questionnaire.question', [
            'isMultiChoice' => $questionnaire->type->id !== QuestionnaireTypeEnum::BINARY_CHOICE->value,
            'questionnaire' => $questionnaire,
            'question' => $question,
            'answers' => $question->answers,
        ]);
    }

    public function submitAnswer(SubmitAnswerRequest $request, Questionnaire $questionnaire, Question $question): View|RedirectResponse
    {
        $session = QuestionnaireSession::ofGuestQuestionnaire(session('guest'), $questionnaire->id)->first();

        if (now()->diffInMinutes($session->created_at) >= 5) {
            $session->delete();

            return redirect()->route('questionnaires.timeout', ['questionnaire' => $questionnaire->id]);
        }

        $areAllAnswersCorrect = 0 === $question->correctAnswers()->pluck('answer_id')->diff($request->answers)->count();

        session([
            'score' => session('score') + ($areAllAnswersCorrect ? 1 : 0),
        ]);

        return redirect()->route('questionnaires.question', ['questionnaire' => $questionnaire->id]);
    }

    public function score(Score $score): View
    {
        abort_if($score->guest->id !== session('guest'), Response::HTTP_FORBIDDEN);

        return view('public.questionnaire.score', [
            'score' => $score,
            'questionnaire' => $score->questionnaire,
        ]);
    }

    public function timeout(Questionnaire $questionnaire): View
    {
        return view('public.questionnaire.timeout', ['questionnaire' => $questionnaire]);
    }
}
