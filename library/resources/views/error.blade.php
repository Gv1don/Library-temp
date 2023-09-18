@extends('header')

@section('content')
    <div class="error">
        <h1>Ошибка, элемент имеет связанные записи!</h1>
        <form action="{{ route('Library_card') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary" style="margin-top: 30px; max-height: 40px; max-width: 200px">Вернуться</button>
        </form>
    <div>
@endsection