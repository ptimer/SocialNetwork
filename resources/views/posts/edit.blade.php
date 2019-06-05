@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактировать запись</div>
                <form method="POST" action="{{ route('post_update') }}">
                            @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Редактировать пост</label>
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <textarea class="form-control" name="post" rows="3">{{ $post->description }}</textarea>
                    </div>
                    <input type="submit" class="btn-primary btn" value="Редактировать">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
