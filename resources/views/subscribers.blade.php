@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мои подписчики</div>
                

                @php 
                    $flag = false;
                    // Merge two collections in order to foreach all friends user ever had
                    $friendsOfAnother = Auth::user()->friendsOfAnother;
                    $friendsOfAuth = Auth::user()->friends;
                    $friends = $friendsOfAnother->merge($friendsOfAuth);
              

                @endphp


                @foreach($friends as $friend)
                    @if(

                            ($friend->user_id_2 === Auth::user()->id && $friend->approved == false) 
                        )
                        <a href="{{ route('profile', ['id' => $friend->user1->id]) }}">{{ $friend->user1->lastname }} {{ $friend->user1->firstname }}</a>
                            <img src="/uploads/avatars/{{ $friend->user1->avatar }}" style="width: 150px; height: 150px;">

                            <form method="POST" action="{{ route('people.confirm_friend') }}">
                                @csrf
                                <div class="form-group row">
                                        <input type="hidden" name="id" value="{{ $friend->user1->id }}">
                                        <input type="submit" value="Принять заявку в друзья" class="btn-primary btn">
                                </div>
                            </form>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
