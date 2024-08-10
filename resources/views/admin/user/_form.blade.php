<input type="text" name="" class="autofeel-hack">
<input type="password" name="" class="autofeel-hack">

<div class="mb-3">
  <label>{{ __('Email Address') }}</label>
  <input type="email" name="email" class="form-control" value="{{ $user->email }}" required placeholder="Email address">
</div>

<div class="mb-3">
  <label>{{ __('Name') }}</label>
  <input type="text" name="name" class="form-control" value="{{ $user->name }}" required placeholder="Name">
</div>

<div class="form-check form-switch">
  <input type="hidden" name="active" value="0">
  <input type="checkbox" name="active" id="active" {{$user->active ? 'checked' : ''}} value="1" class="form-check-input">
  <label for="active" class="form-check-label">{{ __('Active') }}</label>
</div>


<div class="mb-3">
  <label>{{ __('Password') }}</label>
  <input type="password" name="password" class="form-control" placeholder="Password">
</div>


<button type="submit" class="btn btn-outline-secondary">
  <i class="fa fa-download"></i> &nbsp; {{ __('Save') }}
</button>

@push('styles')
  <style type="text/css">
    .autofeel-hack {
      position: absolute;
      top: -999px;
    }
  </style>
@endpush