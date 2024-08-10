@extends('auth.layout')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label>{{ __('Login') }}</label>
    <input id="email" type="email" class="@error('email') has-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
        <span class="error-msg" role="alert">{{ $message }}</span>
    @enderror

    <label>{{ __('Password') }}</label>

    <input id="password" type="password" class="@error('password') has-error @enderror" name="password" required autocomplete="current-password">
    @error('password')
        <span class="error-msg" role="alert">{{ $message }}</span>
    @enderror

    <button type="submit">
        {{ __('Login') }}
    </button>

    @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif

</form>
@endsection
