@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header bg-light d-flex justify-content-between">
    <h3>{{ __('Users') }}</h3>
    <a href="{{ route('admin.user.create') }}" class="btn btn-light"><i class="fa fa-plus-square-o"></i> {{ __('New User') }}</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Actions') }}</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Email Address') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <th scope="row">{{$user->id}}</th>
            <td>
              <a href="{{ route('admin.user.edit', $user) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
              @if(Auth::user()->id != $user->id)
              &nbsp;&nbsp;&nbsp;
              <a href="{{ route('admin.user.destroy', $user) }}" title="Delete" class="delete"><i class="fa fa-trash-o"></i></a>
              @endif
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
