<x-layout>
    <h2 class="mb-5">{{ __('Create '.strtolower($questionnaireType->name).' questionnaire') }}</h2>
    <form class="mb-5" method="POST" action="{{ route('admin.questionnaires.store', ['questionnaireType'=>$questionnaireType->id]) }}" x-data="{
            name: '{{ old('name') }}',
            questions: {{ str_replace('"', "'", str_replace("'", '', json_encode(old('questions', [])))) }},
            errors: {{ str_replace('"', "'", json_encode($errors->toArray())) }}
        }">
        @csrf
        <section class="mb-3">
            <label class="form-label" for="name">{{ __('Name') }}</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                x-bind:value="name"
                x-bind:class="errors.name && 'is-invalid'" />
            <span
                class="invalid-feedback"
                x-show="errors.name"
                x-html="errors.name"></span>
        </section>
        @include($questionnaireTypeTemplate)
        <button type="submit" class="btn btn-primary">
            {{ __('Create') }}
        </button>
        <a href="{{ route('admin.questionnaires.index') }}" class="btn btn-outline">
            {{ __('Cancel') }}
        </a>
    </form>
</x-layout>