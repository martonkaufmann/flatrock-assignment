<x-layout>
    <h5>{{ __('Top scores:') }}</h5>
    <ol>
        @foreach ($topScores as $topScore)
            <li>
                {{ __('Name') }}: {{ $topScore->guest->first_name }} {{ $topScore->guest->last_name }},
                {{ __('Score') }}: {{ $topScore->score }},
                {{ __('Duration') }}: {{ $topScore->duration }}
            </li>
        @endforeach
    </ol>
</x-layout>