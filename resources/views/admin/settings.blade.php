@extends('admin.layout')

@section('content')

<form action="{{route('admin.settings.update')}}" method="POST">
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-between sticky">
            <h5 class="title">{{ __('Settings') }}</h5>
            <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('Save') }}</button>
        </div>

        <div class="card-body">
            <input name="_method" type="hidden" value="PUT">
            @csrf

            @foreach($settings as $item)

            <div class="mb-3 row">
                <label class="col-sm-3 col-xl-2 col-form-label">{{$item->title}}</label>
                <div class="col-sm-9 col-xl-10">
                    <textarea class="form-control {{$item->type}}" name="{{$item->key}}">{{$item->value}}</textarea>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</form>

@endsection