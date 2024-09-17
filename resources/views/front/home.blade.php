@extends('front.layout')

@section('content')

@foreach($pages as $page)
<div class="card mb-3">
    <div class="card-header bg-light">
        <h3>{{ $page->title_ua }}</h3>
    </div>
    <div class="card-body">
        {!! $page->preview_ua !!}
    </div>
</div>
@endforeach
@endsection