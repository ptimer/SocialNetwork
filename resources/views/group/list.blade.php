@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Сообщества</div>
                
                @foreach($groups as $group)
                
                <a href="{{ route('group.index', ['id' => $group->id]) }}">{{ $group->name }}</a>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
