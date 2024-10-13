@extends('admin.layout')

@section('content')
<form action="{{route('admin.page.update', $page)}}" method="POST" enctype="multipart/form-data">
<div class="card">
  <div class="card-header bg-light d-flex justify-content-between sticky">
    <h5 class="title">{{ __('Edit Static Page') }}: {{$page->title_ua}}</h5>
    <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('Save') }}</button>
  </div>

  <div class="card-body">


      <input name="_method" type="hidden" value="PUT">
      @csrf

      <div class="accordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panel_common">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#acc_common" aria-expanded="tENe" aria-controls="acc_common">common</button>
          </h2>
          <div id="acc_common" class="accordion-collapse collapse show" aria-labelledby="panel_common">
            <div class="accordion-body">
              <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">{{ __('Slug') }}</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="slug" value="{{$page->slug}}">
                  <span class="form-text text-muted">{{ __('Leave empty if you want to Slug generated from Title UA') }}</span>
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label">{{ __('Title') }}</label>
                <div class="col-sm-9">
                  <div class="input-group mb-1">
                    <span class="input-group-text">UA</span>
                    <input type="text" class="form-control" name="title_ua" value="{{$page->title_ua}}" required>
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">EN</span>
                    <input type="text" class="form-control" name="title_en" value="{{$page->title_en}}" required>
                  </div>
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label">{{ __('Description') }}</label>
                <div class="col-sm-9">
                  <div class="input-group mb-1">
                    <span class="input-group-text">UA</span>
                    <textarea class="form-control tinymce" name="description_ua">{{$page->description_ua}}</textarea>
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">EN</span>
                    <textarea class="form-control tinymce" name="description_en">{{$page->description_en}}</textarea>
                  </div>
                </div>
              </div>

              <div class="mt-3 row">
                <label class="col-sm-3 col-form-label" for="show">{{ __('Show') }}</label>
                <div class="col-sm-9 pt-2">
                  <input type="hidden" name="show" value="0">
                  <input type="checkbox" name="show" id="show" {{$page->show ? 'checked' : ''}} value="1" class="form-check-input">
                  <label class="ps-2 text-muted d-inline pointer" for="show">{{__('Show on the site') }}</label>
                </div>
              </div>

              <div class="mt-3 row">
                <label class="col-sm-3 col-form-label" for="show_in_menu">{{ __('Show in menu') }}</label>
                <div class="col-sm-9 pt-2">
                  <input type="hidden" name="show_in_menu" value="0">
                  <input type="checkbox" name="show_in_menu" id="show_in_menu" {{$page->show_in_menu ? 'checked' : ''}} value="1" class="form-check-input">
                  <label class="ps-2 text-muted d-inline pointer" for="show_in_menu">{{__('Show in menu') }}</label>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="panel_seo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#acc_seo" aria-expanded="tENe" aria-controls="acc_seo">seo</button>
          </h2>
          <div id="acc_seo" class="accordion-collapse collapse show" aria-labelledby="panel_seo">
            <div class="accordion-body">
              <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label">
                  Html Title
                </label>
                <div class="col-sm-9">
                  <div class="input-group mb-1">
                    <span class="input-group-text">UA</span>
                    <input type="text" class="form-control" name="seo_title_ua" value="{{$page->seo_title_ua}}">
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">EN</span>
                    <input type="text" class="form-control" name="seo_title_en" value="{{$page->seo_title_en}}">
                  </div>
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label">Meta-keywords</label>
                <div class="col-sm-9">
                  <div class="input-group mb-1">
                    <span class="input-group-text">UA</span>
                    <input type="text" class="form-control" name="seo_keywords_ua" value="{{$page->seo_keywords_ua}}">
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">EN</span>
                    <input type="text" class="form-control" name="seo_keywords_en" value="{{$page->seo_keywords_en}}">
                  </div>
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label class="col-sm-3 col-form-label">Meta-description</label>
                <div class="col-sm-9">
                  <div class="input-group mb-1">
                    <span class="input-group-text">UA</span>
                    <textarea class="form-control" name="seo_description_ua">{{$page->seo_description_ua}}</textarea>
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">EN</span>
                    <textarea class="form-control" name="seo_description_en">{{$page->seo_description_en}}</textarea>
                  </div>
                </div>
              </div>

              <div class="mt-3 row">
                <label for="noindex" class="col-sm-3 col-form-label">noindex</label>
                <div class="col-sm-9 pt-2">
                  <input type="hidden" name="noindex" value="0">
                  <input type="checkbox" name="noindex" id="noindex" {{$page->noindex ? 'checked' : ''}} value="1" class="form-check-input">
                  <label class="ps-2 text-muted d-inline pointer" for="noindex">{{__('Prevent robots from indexing of a page') }}</label>
                </div>
              </div>
              <div class="mt-3 row">
                <label for="nofollow" class="col-sm-3 col-form-label">nofollow</label>
                <div class="col-sm-9 pt-2">
                  <input type="hidden" name="nofollow" value="0">
                  <input type="checkbox" name="nofollow" id="nofollow" {{$page->nofollow ? 'checked' : ''}} value="1" class="form-check-input">
                  <label class="ps-2 text-muted d-inline pointer" for="nofollow">{{__('Prevent robots from following links on the page') }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

  </div>
</div>
</form>

@endsection
