@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Создать новое сообщество</div>
            
                        <form method="POST" action="{{ route('group.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input id="name" class="form-control" type="text" name="name">
                                    <label for="textarea">Описание</label>
                                    <textarea class="form-control" id="textarea" name="description" rows="3"></textarea>
                                </div>
                            <input type="submit" class="btn-primary btn" value="Создать">
                        </form>

            </div>
        </div>
    </div>
</div>
@endsection
