@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Люди</div>
                
                @if(Auth::check())

                    @foreach($people as $person)
                        <div>
                            <a href="{{ route('profile', ['id' => $person->id]) }}">{{ $person->lastname }} {{ $person->firstname }}</a>
                            <img src="/uploads/avatars/{{ $person->avatar }}" style="width: 150px; height: 150px;">

                            
                            @php 
                                $flag = false;
                                // Merge two collections in order to foreach all friends user ever had
                                $friendsOfAnother = Auth::user()->friendsOfAnother;
                                $friendsOfAuth = Auth::user()->friends;
                                $friends = $friendsOfAnother->merge($friendsOfAuth);
                  

                            @endphp

      
                            @foreach ($friends as $friend)
                                {{-- Отменить заявку (для юзера, который отправляет) --}}

                                @if($friend->user_id_2 === $person->id && $friend->user_id_1 === Auth::user()->id)
                                    @php $flag = true; @endphp
                                @endif
                                
                                {{-- Подтвердить заявку (для юзера, который получает) --}}
                                @if($friend->user_id_2 === Auth::user()->id && $friend->user_id_1 === $person->id)
                                    @php $flag = 'confirm'; @endphp
                                @endif
     

                                {{-- В друзьях --}}
                                @if(

                                    ($friend->user_id_1 === $person->id && $friend->user_id_2 === Auth::user()->id && $friend->approved == true) 

                                    || 

                                    ($friend->user_id_1 === Auth::user()->id && $friend->user_id_2 === $person->id && $friend->approved == true)
                                )

                                    @php $flag = 'approved'; @endphp
                                @endif

                                
                            @endforeach

                            @if($flag === 'approved')
                                <form method="POST">
                                        @csrf
                                        <div class="form-group row">
                                                <input type="hidden" name="id" value="{{ $person->id }}">
                                                <input type="submit" value="В друзьях" class="btn-primary btn">
                                        </div>
                                </form>
                            @elseif($flag === 'confirm')
                                <form method="POST" action="{{ route('people.confirm_friend') }}">
                                        @csrf
                                        <div class="form-group row">
                                                <input type="hidden" name="id" value="{{ $person->id }}">
                                                <input type="submit" value="Подтвердить заявку" class="btn-primary btn">
                                        </div>
                                </form>
                            @elseif($flag == true)
                                <form method="POST" action="{{ route('people.cancel_friend') }}">
                                        @csrf
                                        <div class="form-group row">
                                                <input type="hidden" name="id" value="{{ $person->id }}">
                                                <input type="submit" value="Отменить заявку" class="btn-primary btn">
                                        </div>
                                </form>     
                            @elseif($flag == false)
                                <form method="POST" action="{{ route('people.add_friend') }}">
                                        @csrf
                                        <div class="form-group row">
                                                <input type="hidden" name="id" value="{{ $person->id }}">
                                                <input type="submit" value="Добавить в друзья" class="btn-primary btn">
                                        </div>
                                </form>
                            @endif                        
                        </div>
                    @endforeach


                @else

                    @foreach($people as $person)
                        <div>
                            <a href="{{ route('profile', ['id' => $person->id]) }}">{{ $person->lastname }} {{ $person->firstname }}</a>
                            <img src="/uploads/avatars/{{ $person->avatar }}" style="width: 150px; height: 150px;">
                    @endforeach
                    
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
