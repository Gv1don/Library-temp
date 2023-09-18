@extends('header')

@section('content')
    <form class="createForm" action="{{ route('update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Название жанра</label>
            <input name="name" value="{{ $genre->name }}" type="text" class="form-control" id="formGroupExampleInput" placeholder="Название жанра" required pattern="[А-Яа-яёЁ\s]+">
            <input type="hidden" name="id" value="{{ $genre->genre_id }}">
        </div>
        <button name="type" value="Genre" type="submit" class="btn btn-primary submit">Подтвердить</button>
    </form>
@endsection