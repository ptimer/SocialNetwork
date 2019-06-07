@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Сообщество</div>
                <h4>{{ $group->name }}</h4>

                
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Аватар</div>
                @if(auth::check())
                    @if(!$status_user->first())
                        <form method="POST" action="{{ route('group.subscribe') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $group->id }}">
                                <input type="submit" class="btn-primary btn" value="Подписаться">
                        </form>
                    @else
                        <form method="POST" action="{{ route('group.unsubscribe') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $group->id }}">
                                <input type="submit" class="btn-primary btn" value="Отписаться">
                        </form>
                    @endif
                @endif
                <div>
                    <h5>Подписчики</h5>
                    <ul>
                        @foreach($group->subscribers as $subscriber)
                            <li>{{ $subscriber->lastname. ' '. $subscriber->firstname }}</li>
                        @endforeach
                    </ul>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
