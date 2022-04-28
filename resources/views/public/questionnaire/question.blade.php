<x-layout>
    <h4>{{ $question->content }}</h4>
    <form
        method="POST"
        action="{{ route('questionnaires.submit', ['questionnaire' => $questionnaire->id, 'question' => $question->id]) }}"
        class="me-3"
    >
        @csrf
        <ul class="list-group mb-3">
            @foreach ($answers as $answer)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <label for="answers.{{ $answer->id }}">
                        {{ $answer->content }}
                    </label>
                    @if ($isMultiChoice)
                        <input type="checkbox" name="answers[]" id="answers.{{ $answer->id }}" value="{{ $answer->id }}" />
                    @else
                        <input type="radio" name="answers[]" id="answers.{{ $answer->id }}" value="{{ $answer->id }}" />
                    @endif
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary ms-auto d-block">
            {{ __('Submit answer') }}
        </button>
    </form>
</x-layout>