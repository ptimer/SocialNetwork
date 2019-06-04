@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>{{ $user->lastname }} {{ $user->firstname }}</h2>
                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 10%;">
                    

                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <form method="POST" action="{{ route('profile.upload_avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Изменить фотографию') }}</label>

                                <div class="col-md-8">
                                    <input id="avatar" type="file" name="avatar">
                                    <input type="submit" class="btn-primary btn">
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
