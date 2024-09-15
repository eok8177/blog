<nav aria-label="Page navigation">
  <ul class="pagination mb-0">

    {{-- Info --}}
    <li class="me-2 page-item disabled">
      <span class="page-link">
        {{$paginator->firstItem()}} - {{$paginator->lastItem()}} из: {{$paginator->total()}}
      </span>
    </li>

  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <li class="page-item disabled"><span class="page-link"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span></li>
  @else
    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span><span class="sr-only">Previous</span></a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><span class="sr-only">Next</span></a></li>
  @else
    <li class="page-item disabled"><span class="page-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></li>
  @endif

  {{-- Dropdown perPage --}}
  <li class="ms-2 page-item disabled">
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="paginateBtn" data-bs-toggle="dropdown" aria-expanded="false">
        {{ request()->input('paginate') ? request()->input('paginate') : '50' }}
      </button>
      <ul class="dropdown-menu" aria-labelledby="paginateBtn">
        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paginate' => 20, 'page' => 1])}}">20</a></li>
        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paginate' => 50, 'page' => 1])}}">50</a></li>
        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paginate' => 100, 'page' => 1])}}">100</a></li>
        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paginate' => 200, 'page' => 1])}}">200</a></li>
        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paginate' => 500, 'page' => 1])}}">500</a></li>
      </ul>
    </div>
  </li>

  </ul>

</nav>
