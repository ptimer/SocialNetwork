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


                    @if(Auth::check() && Auth::user()->id == $user_id)
                        <form method="POST" action="{{ route('post_record') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Новый пост</label>
                                <textarea class="form-control" name="post" rows="3"></textarea>
                            </div>
                            <input type="submit" class="btn-primary btn" value="Опубликовать">
                        </form>
                    @endif

                    @foreach($posts as $post)
                        <div style="border: 1px solid black;">
                            <p class="font-weight-normal">{{ $post->description }}</p>
                        
                            <i>Дата публикации: {{ $post->created_at }}</i>

                            @if(Auth::check())
                                      @php 
                                        $results = $post->likes->where('user_id', Auth::user()->id)->first()
                                      @endphp
                                      @if($results == null)
                                        <a href="{{ route('post_like', ['id' => $post->id]) }}" class="btn btn-default btn-sm">
                                            <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-thumbs-up"></span> Нравится
                                            </button>
                                        </a>
                                      @else
                                        <a href="{{ route('post_dislike', ['id' => $results->id]) }}" class="btn btn-default btn-sm">
                                            <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-thumbs-up"></span> Не нравится
                                            </button>
                                        </a>
                                      @endif
                            @endif

                            Лайков: <b>{{ $post->likes->count() }}</b>
                            <div>
                                @foreach($post->likes as $like)
                                    <a href="{{ route('profile', ['id' => $like->user->id]) }}" title="{{ $like->user->lastname . ' ' . $like->user->firstname}}">
                                        <img src="/uploads/avatars/{{ $like->user->avatar }}" style="width: 30px; height: 30px; border-radius: 10%;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        
                        @if(Auth::check() && Auth::user()->id == $user_id)       
                           <a href="{{ route('post_edit', ['id' => $post->id]) }}" class="btn btn-outline-success">Редактировать</a> 
                           <a href="{{ route('post_delete', ['id' => $post->id]) }}" class="btn btn-outline-danger">Удалить</a> 
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
