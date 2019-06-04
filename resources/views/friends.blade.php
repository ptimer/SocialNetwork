@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мои друзья</div>
                

                @foreach(Auth::user()->friendsOfAnother as $person)
                    <a href="{{ route('profile', ['id' => $person->user1->id]) }}">{{ $person->user1->lastname }} {{ $person->user1->firstname }}</a>
                        <img src="/uploads/avatars/{{ $person->user1->avatar }}" style="width: 150px; height: 150px;">

                        <form method="POST" action="{{ route('people.add_friend') }}">
                            @csrf
                            <div class="form-group row">
                                    <input type="hidden" name="id" value="{{ $person->user1->id }}">
                                    <input type="submit" value="Удалить из друзей" class="btn-primary btn">
                            </div>
                        </form>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
