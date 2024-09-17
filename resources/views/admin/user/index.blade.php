@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header bg-light d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ __('Users') }}</h5>
    <a href="{{ route('admin.user.create') }}" class="btn btn-light"><i class="fa fa-plus-square-o"></i> {{ __('New User') }}</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Email Address') }}</th>
            <th scope="col">{{ __('Active') }}</th>
            <th scope="col" class="text-start">{{ __('Actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <th width="1%">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->active}}</td>
            <td class="text-start text-nowrap" width="1%">
              <a href="{{ route('admin.user.edit', $user) }}" title="Edit" class="btn btn-sm">
                <i class="fa fa-pencil-square-o"></i>
              </a>
              @if(Auth::user()->id != $user->id)
              <a href="{{ route('admin.user.destroy', $user) }}" title="Delete" class="delete btn btn-sm text-danger ms-3">
                <i class="fa fa-trash-o"></i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection

@push('styles')
<style>
  table {
    font-size: 13px;
  }
</style>
@endpush