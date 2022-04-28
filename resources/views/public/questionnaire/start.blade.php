<x-layout>
    <h4>"{{ $oldQuestionnaire->name }}"{{ __('already in progress') }}</h4>
    <section class="d-flex">
        <form
            method="POST"
            action="{{ route('questionnaires.cancel', ['questionnaire' => $newQuestionnaire->id]) }}"
            class="me-3"
        >
            @csrf
            @method('DELETE')

            <button class="btn btn-primary">
                {{ __("Start") }} "{{ $newQuestionnaire->name }}"
            </button>
        </form>
        <a
            href="{{ route('questionnaires.question', ['questionnaire' => $oldQuestionnaire->id]) }}"
            class="btn btn-outline-secondary"
        >
            {{ __("Continue") }} "{{ $oldQuestionnaire->name }}"
        </a>
    </section>
</x-layout>