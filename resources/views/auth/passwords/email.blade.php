@extends('auth.layout')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <h1>{{ __('Reset Password') }}</h1>


    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <label>{{ __('Email Address') }}</label>

    <input id="email" type="email" class="form-control @error('email') has-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

    @error('email')
        <span class="error-msg" role="alert">{{ $message }}</span>
    @enderror

    <button type="submit">
        {{ __('Send Password Reset Link') }}
    </button>
</form>
@endsection
