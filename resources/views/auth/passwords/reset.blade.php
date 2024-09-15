@extends('auth.layout')

@section('content')

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <h1>{{ __('Reset Password') }}</h1>

    <input type="hidden" name="token" value="{{ $token }}">

    <label>{{ __('Email Address') }}</label>
    <input type="email" class="@error('email') has-error @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    @error('email')
        <span class="error-msg">{{ $message }}</span>
    @enderror

    <label>{{ __('Password') }}</label>
    <input type="password" class="@error('password') has-error @enderror" name="password" required autocomplete="new-password">
    @error('password')
        <span class="error-msg">{{ $message }}</span>
    @enderror


    <label>{{ __('Confirm Password') }}</label>
    <input type="password" name="password_confirmation" required autocomplete="new-password">

    <button type="submit">
        {{ __('Reset Password') }}
    </button>

    <a href="{{ route('login') }}">
        {{ __('Login') }}
    </a>
</form>
@endsection
