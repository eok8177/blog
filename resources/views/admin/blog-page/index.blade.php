@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header bg-light d-sm-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ __('Blog Pages') }}</h5>

    <div class="pagination">
      {{ $pages->appends(request()->except('page'))->links('admin.include.pagination') }}
    </div>

    <div class="d-none d-md-block">
      <form action="">
        <div class="input-group">
          <input type="text" name="search" value="{{request()->input('search')}}" class="form-control">
          <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </form>
    </div>

    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal">
      <i class="fa fa-plus-square-o"></i> {{ __('Create') }}
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">slug</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col" class="text-start">{{ __('Actions') }}</th>
          </tr>
        </thead>
        @foreach($pages as $page)
          <tr>
            <td width="1%">{{$page->id}}</td>
            <td>
              <a href="{{route('admin.blog-page.edit', $page)}}" class="text-body">{{$page->slug}}</a>
            </td>

            <td>{{$page->title_ua}}</td>

            <td class="text-start text-nowrap" width="1%">
              <a href="{{route('admin.blog-page.edit', $page)}}" class="btn btn-sm">
                <i class="fa fa-pencil-square-o"></i>
              </a>

              <a href="{{route('admin.blog-page.destroy',$page)}}" class="delete btn btn-sm text-danger ms-3">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">{{ __('Create New Category') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('admin.blog-page.store')}}" method="POST">
        @csrf
        <div class="modal-body">

          <div class="mb-3 row align-items-center">
            <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
            <div class="col-sm-10">
              <div class="input-group mb-1">
                <span class="input-group-text">UA</span>
                <input type="text" class="form-control" id="title_ua" name="title_ua" required>
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <input type="text" class="form-control" id="title_en" name="title_en" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
          <button type="submit" class="btn btn-outline-primary">{{ __('Create') }}</button>
        </div>
      </form>
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