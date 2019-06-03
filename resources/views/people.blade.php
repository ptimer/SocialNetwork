@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Люди</div>
                
                @foreach($people as $person)
                    <div>
                        <a href="{{ route('profile', ['id' => $person->id]) }}">{{ $person->lastname }} {{ $person->firstname }}</a>
                        <img src="/uploads/avatars/{{ $person->avatar }}" style="width: 150px; height: 150px;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
