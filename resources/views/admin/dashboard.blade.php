@extends('layouts.master')

@section('title', 'Главная')

@section('content')
    <h4>Ваш токен</h4>
    <form method="POST"  action="{{ route('regenerate') }}">
        @csrf
        <div class="input-group row">
            <label for="name" class="col-sm-2 col-form-label">Токен:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="token" id="token" value="{{ $token }}" disabled>
            </div>
        </div>
        <button class="btn btn-success">Генерировать</button>
    </form>
@endsection
