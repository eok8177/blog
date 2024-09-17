@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h5 class="mb-0">{{ __('Dashboard') }}</h5>
    </div>

    <div class="card-body">
        <div class="mb-5">
            Main statistics
            <dl>
              <dt>{{ __('Total Categories') }}</dt>
              <dd>{{ $categories->count() }}</dd>
            </dl>
            <dl>
              <dt>{{ __('Total Pages') }}</dt>
              <dd>{{ $pages->count() }}</dd>
            </dl>
        </div>
        <div class="text-muted">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
  </div>
@endsection