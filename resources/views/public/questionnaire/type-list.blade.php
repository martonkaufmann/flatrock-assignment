<x-layout>
    <h4>{{ __('Select questionnaire type') }}</h4>
    @foreach ($questionnaireTypes as $questionnaireType)
        <a href="{{ route('questionnaires.list', ['questionnaireType' => $questionnaireType->id]) }}">
            {{ __($questionnaireType->name) }}
        </a>
    @endforeach
</x-layout>