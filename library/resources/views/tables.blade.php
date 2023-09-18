@extends('header')

@section('content')
    <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="{{ route('Library_card') }}">История</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ route('Reader') }}">Читатели</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ route('Book') }}">Книги</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ route('Genre') }}">Жанры</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ route('Author') }}">Авторы</a>
        </div>
    </nav>
    <main>
        @switch($type)
            @case('Author')
                @include('authors_table')
                @break
            @case('Book')
                @include('books_table')
                @break
            @case('Reader')
                @include('readers_table')
                @break
            @case('Library_card')
                @include('story_table')
                @break
            @case('Genre')
                @include('genres_table')
                @break
        @endswitch
    </main>

@endsection