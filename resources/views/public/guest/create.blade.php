<x-layout>
    <h2 class="mb-5">{{ __('Guest') }}</h2>
    <form method="POST" action="{{ route('guests.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="email">{{ __('Email address') }}</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" />
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="first_name">{{ __('First name') }}</label>
            <input
                type="text"
                name="first_name"
                id="first_name"
                value="{{ old('first_name') }}"
                class="form-control @error('first_name') is-invalid @enderror" />
            @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="last_name">{{ __('Last name') }}</label>
            <input
                type="text"
                name="last_name"
                id="last_name"
                value="{{ old('last_name') }}"
                class="form-control @error('last_name') is-invalid @enderror" />
            @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Play') }}</button>
    </form>
</x-layout>