<x-layout>
    <h4>{{ __('Score') }}: {{ $score->score }}</h4>
    <h4>{{ __('Duration') }}: {{ $score->duration }}</h4>
    <a href="{{ route('questionnaires.start', ['questionnaire' => $questionnaire->id]) }}">
        {{ __('Retry') }}
    </a>
    <a href="{{ route('questionnaires.type-list') }}">
        {{ __('Back') }}
    </a>
</x-layout>