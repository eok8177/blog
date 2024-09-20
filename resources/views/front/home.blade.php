@extends('front.layout')

@section('content')

@foreach($pages as $post)
<div class="article mb-3">
    <div class="title">
        <h3>
            <a href="{{ locale_route('front.post', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>
    </div>
    <div class="preview">
        <img src="{{ $post->image }}" alt="{{ $post->title }}">
        {!! $post->preview !!}
    </div>
</div>
@endforeach
@endsection