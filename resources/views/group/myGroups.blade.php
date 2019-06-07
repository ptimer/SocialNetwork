@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Мои сообщества
                    <ul>
                        <li><a href="{{ route('group.myGroupsAdmin') }}">Управление созданными сообществами</a></li>
                        <li><a href="{{ route('group.createGroup') }}">Создать группу</a></li>
                    </ul>
                </div>
                
                @foreach($groups as $group)
                
                    <a href="{{ route('group.index', ['id' => $group->id]) }}">{{ $group->name }}</a>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
