@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header bg-light">
    <h3><small>{{ __('User') }} </small>{{ $user->name }}</h3>
  </div>

  <div class="card-body">

    <form action="{{route('admin.user.update', $user)}}" method="POST">
      <input name="_method" type="hidden" value="PUT">
      @csrf
      @include('admin.user._form')
    </form>

  </div>
</div>

@endsection