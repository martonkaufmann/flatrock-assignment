<section class="mb-3">
    <header class="d-flex justify-content-between mb-3">
        <h5>{{ __('Questions') }}</h5>
        <button
            type="button"
            class="btn btn-light"
            x-show="questions.length < 10"
            x-on:click="questions.push({content:'', answers:[]})"
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
                        x-show="question.answers.length < 3"
                        x-on:click="question.answers.push({content: '', is_correct: false})"
                    >
                        {{ __('Add answer') }}
                    </button>
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
                <ol x-bind:class="errors[`questions.${i}.answers`] && 'is-invalid'">
                    <template x-for="answer, j in question.answers">
                        <li class="mb-3">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    x-bind:name="`questions[${i}][answers][${j}][content]`"
                                    x-bind:value="answer.content"
                                    x-bind:class="errors[`questions.${i}.answers.${j}.content`] && 'is-invalid'" />
                                <button type="button" class="btn btn-outline-secondary" x-on:click="questions[i].answers.splice(j, 1)">
                                    {{ __('Remove answer') }}
                                </button>
                                <span
                                    class="invalid-feedback"
                                    x-show="errors[`questions.${i}.answers.${j}.content`]"
                                    x-html="errors[`questions.${i}.answers.${j}.content`]"></span>
                            </div>
                            <div>
                                <label
                                    x-bind:label="`questions[${i}][answers][${j}][is_correct]`"
                                    x-bind:for="`questions[${i}][answers][${j}][is_correct]`"
                                >
                                    {{ __('Is correct:') }}
                                </label>
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    x-bind:id="`questions[${i}][answers][${j}][is_correct]`"
                                    x-bind:name="`questions[${i}][answers][${j}][is_correct]`"
                                    value="1"
                                />
                            </div>
                        </li>
                    </template>
                </ol>
                <span
                    class="invalid-feedback"
                    x-show="errors[`questions.${i}.answers`]"
                    x-html="errors[`questions.${i}.answers`]"></span>
            </li>
        </template>
    </ol>
    <span
        class="invalid-feedback"
        x-show="errors.questions"
        x-html="errors.questions"></span>
</section>