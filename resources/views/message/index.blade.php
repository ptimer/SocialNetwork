@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Мои сообщения</div>
                <chat-app :user="{{ auth()->user() }}"></chat-app>
            </div>
        </div>
    </div>
</div>
@endsection
