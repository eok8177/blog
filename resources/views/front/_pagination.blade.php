@if ($paginator->hasPages())
<ul class="pagination">
  {{-- Previous Page Link --}}
  @if (!$paginator->onFirstPage())
  <li class="me-2 me-md-5">
    <a href="{{preg_replace('/\?page=1$/', '', $paginator->previousPageUrl())}}" aria-label="Previous">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m11 17-5-5 5-5"/>
        <path d="m18 17-5-5 5-5"/>
      </svg>
    </a>
  </li>
  @endif

  @php
    $start = $paginator->currentPage() - 1; // show 3 pagination links before current
    $end = $paginator->currentPage() + 1; // show 3 pagination links after current
    if($start < 1) {
        $start = 1; // reset start to 1
        $end += 1;
      }
    if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
  @endphp

  @if($start > 1)
  <li>
    <a href="{{preg_replace('/\?page=1$/', '',$paginator->url(1))}}">1</a>
  </li>
    @if($paginator->currentPage() != 3)
    {{-- "Three Dots" Separator --}}
    <li class="disabled">
      <span>. . .</span>
    </li>
    @endif
  @endif

  @for ($i = $start; $i <= $end; $i++)
    @if($paginator->currentPage() == $i)
    <li class="active">
      <span>{{ $i }}</span>
    </li>
    @else
    <li>
      <a href="{{preg_replace('/\?page=1$/', '',$paginator->url($i))}}">{{ $i }}</a>
    </li>
    @endif
  @endfor

  @if($end < $paginator->lastPage())
  @if($paginator->currentPage() + 3 != $paginator->lastPage())
  {{-- "Three Dots" Separator --}}
  <li class="disabled">
    <span>. . .</span>
  </li>
  @endif
  <li>
    <a href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
  </li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
  <li class="ms-2 ms-md-5">
    <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m6 17 5-5-5-5"/>
        <path d="m13 17 5-5-5-5"/>
      </svg>
    </a>
  </li>
  @endif
</ul>
@endif