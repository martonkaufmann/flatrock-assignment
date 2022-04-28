<x-layout>
    <h5>{{ __('Create questionnaire:') }}</h5>
    <ul class="list-group list-group-horizontal mb-5">
        @foreach ($questionnaireTypes as $questionnaireType)
        <li class="list-group-item w-100 text-center">
            <a href="{{ route('admin.questionnaires.create', ['questionnaireType'=>$questionnaireType->id]) }}">
                {{ $questionnaireType->name }}
            </a>
        </li>
        @endforeach
      </ul>
      <h5>{{ __('Questionnaires:') }}</h5>
      <ul class="list-group">
          @foreach ($questionnaires as $questionnaire)
          <li class="list-group-item w-100 text-center">
              <a href="{{ route('admin.questionnaires.show', ['questionnaire' => $questionnaire->id]) }}">
                  {{ $questionnaire->name }}
              </a>
          </li>
          @endforeach
        </ul>
</x-layout>