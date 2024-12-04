@extends('front.layout')

@section('content')

<div class="article mb-3">
    <div class="title">
        <h3>{{ $page->title }}</h3>
    </div>
    <div class="description">
        {!! $page->description !!}
    </div>
</div>
@endsection

@push('head')
  @if($page->noindex == 1 && $page->nofollow == 1)
  <meta name="robots" content="noindex, nofollow">
  @elseif($page->noindex == 1)
  <meta name="robots" content="noindex">
  @elseif($page->nofollow == 1)
  <meta name="robots" content="nofollow">
  @endif

  <link rel="canonical" href="{{locale_route('front.page',$page->slug)}}">
  <link rel="alternate" hreflang="en" href="{{locale_route('front.page',$page->slug, 'en')}}">
  <link rel="alternate" hreflang="uk" href="{{locale_route('front.page',$page->slug, 'ua')}}">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type":"WebPage",
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
  {{-- <meta property="og:image" content="{{ request()->root().'/'.$page->image }}"> --}}
@endpush