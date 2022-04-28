<x-layout>
    <h4>{{ __('Questionnaire timed out') }}</h4>
    <a href="{{ route('questionnaires.start', ['questionnaire' => $questionnaire->id]) }}">
        {{ __('Restart') }}
    </a>
    <a href="{{ route('questionnaires.type-list') }}">
        {{ __('Back') }}
    </a>
</x-layout>