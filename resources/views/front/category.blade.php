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

{{ $pages->appends(request()->except('page'))->links('front._pagination') }}

@endsection

@push('head')
  <link rel="canonical" href="{{locale_route('front.category', $category->slug)}}">
  <link rel="alternate" hreflang="en" href="{{locale_route('front.category', $category->slug, 'en')}}">
  <link rel="alternate" hreflang="ua" href="{{locale_route('front.category', $category->slug, 'ua')}}">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type":"WebPages",
    "name":"{{$seo_title}}",
    "description":"{{$seo_description}}",
    "url": "{{request()->url()}}/"
  }
  </script>

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:title" content="{{ $seo_title }}" />
  <meta property="og:description" content="{{ strip_tags($seo_description) }}" />
  <meta property="og:url" content="{{ request()->url() }}">
  <meta property="og:locale" content="{{ app()->getLocale() == 'en' ? 'en_US' : 'uk_UA' }}">
  <meta property="og:image" content="{{ request()->root().$pages->first()->image }}">
@endpush