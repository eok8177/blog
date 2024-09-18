@extends('front.layout')

@section('content')

<div class="article mb-3">
    <div class="title">
        <h3>{{ $post->title }}</h3>
    </div>
    <div class="description">
        {!! $post->description !!}
    </div>
</div>
@endsection