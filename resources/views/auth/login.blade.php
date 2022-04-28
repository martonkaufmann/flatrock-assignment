<x-layout>
    <h2 class="mb-5">{{ __('Log in') }}</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="email">{{ __('Email address') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="remember_me" class="form-check-label">
              {{ __('Remember me') }}
            </label>
            <input type="checkbox" name="remember" class="form-check-input">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
    </form>
</x-layout>