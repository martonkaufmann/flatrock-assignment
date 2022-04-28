<section class="mb-3">
    <header class="d-flex justify-content-between mb-3">
        <h5>{{ __('Questions') }}</h5>
        <button
            type="button"
            class="btn btn-light"
            x-show="questions.length < 10"
            x-on:click="questions.push({content:''})"
        >
            {{ __('Add question') }}
        </button>
    </header>
    <ol class="list-group" x-bind:class="errors.questions && 'is-invalid'">
        <template  x-for="question, i in questions">
            <li class="list-group-item">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        x-bind:name="`questions[${i}][content]`"
                        x-bind:value="question.content"
                        x-bind:class="errors[`questions.${i}.content`] && 'is-invalid'" />
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        x-on:click="questions.splice(i, 1);"
                    >
                        {{ __('Remove question') }}
                    </button>
                    <span
                        class="invalid-feedback"
                        x-show="errors[`questions.${i}.content`]"
                        x-html="errors[`questions.${i}.content`]"></span>
                </div>
                <div>
                    <span class="me-2">{{ __('Correct answer:') }}</span>
                    <label class="me-2">
                        {{ __('No') }}
                        <input
                            type="radio"
                            class="form-check-input"
                            x-bind:name="`questions[${i}][correct_anwer]`"
                            x-bind:value="1" />
                    </label>
                    <label>
                        {{ __('Yes') }}
                        <input
                            type="radio"
                            class="form-check-input"
                            x-bind:name="`questions[${i}][correct_anwer]`"
                            x-bind:value="2" />
                    </label>
                </div>
                <span
                    class="invalid-feedback"
                    x-show="`questions[${i}][correct_anwer]`"
                    x-html="`questions[${i}][correct_anwer]`"></span>
            </li>
        </template>
    </ol>
    <span
        class="invalid-feedback"
        x-show="errors.questions"
        x-html="errors.questions"></span>
</section>