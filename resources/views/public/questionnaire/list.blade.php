<x-layout>
    <h4>{{ __('Select questionnaire') }}</h4>
    <ul class="list-group list-group-flush">
    @foreach ($questionnaires as $questionnaire)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ __($questionnaire->name) }}</span>
            <a
                href="{{ route('questionnaires.start', ['questionnaire' => $questionnaire->id]) }}"
                class="btn btn-outline-primary"
            >
                {{ __('Start') }}
            </a>
        </li>
    @endforeach
    </ul>
</x-layout>