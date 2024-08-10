@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header bg-light">
    <h3>{{__('New User')}}</h3>
  </div>

  <div class="card-body">

    <form action="{{route('admin.user.store')}}" method="POST">
      @csrf
      @include('admin.user._form')
    </form>

  </div>
</div>

@endsection
