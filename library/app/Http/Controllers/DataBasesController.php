<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\Reader;
use App\Models\Genre;
use App\Models\Library_card;
use App\Models\Book;
use Psy\Readline\Hoa\Console;

class DataBasesController
{
    public function Feeling(Request $request){

        $url = $request->url();
        $type = rtrim(substr($url, strrpos($url, '/') + 1), '/');

        if($type == 'Library_card'){
            $table = DB::table('Library_card')
                ->join('Book', 'Library_card.book_id', '=', 'Book.book_id')
                ->join('Author', 'Book.author', '=', 'Author.author_id')
                ->join('Genre', 'Book.genre', '=', 'Genre.genre_id')
                ->join('Reader', 'Reader.reader_id', '=', 'Library_card.reader_id')
                ->select('Reader.name as name', 'Reader.phone', 'Book.title', 'Author.name as author', 'Library_card.date', 'Library_card.id')
                ->get();
        }
        elseif($type == 'Book'){
            $table = DB::table('Book')
                ->join('Author', 'Book.author', '=', 'Author.author_id')
                ->join('Genre', 'Book.genre', '=', 'Genre.genre_id')
                ->select('Author.name as author', 'Genre.name as genre', 'Book.title', 'Book.age_rating', 'Book.book_id')
                ->get();
        }
        else{
            $table = DB::table($type)->get();
        }

        return view('tables', compact('table', 'type'));
    }

    public function Create(Request $request){

        $type = $request->type;
        switch($type){
            case 'Author':
                return view('create_author');
                break;

            case 'Genre':
                return view('create_genre');
                break;

            case 'Book':
                $authors = DB::table('Author')->pluck('name', 'author_id');
                $genres = DB::table('Genre')->pluck('name', 'genre_id');
                return view('create_book', compact('authors', 'genres'));
                break;

            case 'Reader':
                return view('create_reader');
                break;

            case 'Library_card':
                $books = DB::table('Book')
                ->join('Author', 'Book.author', '=', 'Author.author_id')
                ->join('Genre', 'Book.genre', '=', 'Genre.genre_id')
                ->select('Book.book_id', 'Book.title', 'Author.name as author_name', 'Genre.name as genre_name')
                ->get();
                $readers = DB::table('Reader')->pluck('name', 'reader_id');
                return view('create_story', compact('books', 'readers'));
                break;

            default:
                return redirect()->route('Library_card');
        }
    }

    public function CreateSave(Request $request){
        $type = $request->input('type');

        switch($type){
            case 'Author':
                $name = $request->input('name');
                $author = Author::where('name', $name)->first();
                if(!$author){
                    $author = new Author();
                    $author->name = $name;
                    $author->save();
                }

                return redirect()->route('Author');
                break;

            case 'Book':
                $title = $request->input('title');
                $author = $request->input('author');
                $genre = $request->input('genre');
                $age_rating = $request->input('age_rating');

                $book = new Book();
                $book->title = $title;
                $book->author = $author;
                $book->genre = $genre;
                $book->age_rating = $age_rating;
                $book->save();

                return redirect()->route('Book');
                break;

            case 'Genre':
                $name = $request->input('name');
                $genre = Genre::where('name', $name)->first();

                if(!$genre){
                    $genre = new Genre();
                    $genre->name = $name;
                    $genre->save();
                }

                return redirect()->route('Genre');
                break;

            case 'Reader':
                $name = $request->input('name');
                $phone = $request->input('phone');
                $birth = $request->input('birth_date');
                $reader = Reader::where('name', $name)->where('phone', $phone)->where('birth_date', $birth)->first();

                if(!$reader){
                    $reader = new Reader();
                    $reader->name = $name;
                    $reader->phone = $phone;
                    $reader->birth_date = $birth;
                    $reader->save();
                }

                return redirect()->route('Reader');
                break;

            case 'Library_card':
                $reader_id = $request->input('reader_id');
                $book_id = $request->input('book_id');
                $story = new Library_card();
                $story->reader_id = $reader_id;
                $story->book_id = $book_id;
                $story->date = date(now());
                $story->save();

                return redirect()->route('Library_card');
                break;

            default:
                return redirect()->route('Library_card');
                break;
        }
    }

    public function Update(Request $request){

        $previousUrl = $request->headers->get('referer');
        $type = rtrim(substr($previousUrl, strrpos($previousUrl, '/') + 1), '/');
        $id = $request->input('id');

        switch($type){
            case 'Author':
                $author = Author::where('author_id', $id)->first();
                return view('update_author', compact('author'));
                break;

            case 'Genre':
                $genre = Genre::where('genre_id', $id)->first();
                return view('update_genre', compact('genre'));
                break;

            case 'Book':
                $books = Book::where('book_id', $id)->first();
                $authors = DB::table('Author')->pluck('name', 'author_id');
                $genres = DB::table('Genre')->pluck('name', 'genre_id');
                return view('update_book', compact('books', 'genres', 'authors'));
                break;

            case 'Reader':
                $reader = Reader::where('reader_id', $id)->first();
                return view('update_reader', compact('reader'));
                break;

            case 'Library_card':
                $books = DB::table('Book')
                ->join('Author', 'Book.author', '=', 'Author.author_id')
                ->join('Genre', 'Book.genre', '=', 'Genre.genre_id')
                ->select('Book.book_id', 'Book.title', 'Author.name as author_name', 'Genre.name as genre_name')
                ->get();
                $readers = DB::table('Reader')->pluck('name', 'reader_id');
                $story = Library_card::where('id', $id)->first();
                return view('update_story', compact('books', 'readers', 'story'));
                break;

            default:
                return redirect()->route('Library_card');
        }
    }

    public function UpdateSave(Request $request){

        $type = $request->input('type');
        $id = $request->id;

        switch($type){
            case 'Author':
                $name = $request->input('name');
                $author = Author::where('name', $name)->first();

                if(!$author){
                    $author = Author::where('author_id', $id)->first();
                    $author->name = $name;
                    $author->save();
                }

                return redirect()->route('Author');
                break;

            case 'Book':
                $title = $request->input('title');
                $author = $request->input('author');
                $genre = $request->input('genre');
                $age_rating = $request->input('age_rating');

                $book = Book::where('book_id', $id)->first();
                $book->title = $title;
                $book->author = $author;
                $book->genre = $genre;
                $book->age_rating = $age_rating;
                $book->save();

                return redirect()->route('Book');
                break;

            case 'Genre':
                $name = $request->input('name');
                $genre = Genre::where('name', $name)->first();

                if(!$genre){
                    $genre = Genre::where('genre_id', $id)->first();
                    $genre->name = $name;
                    $genre->save();
                }

                return redirect()->route('Genre');
                break;

            case 'Reader':
                $name = $request->input('name');
                $phone = $request->input('phone');
                $birth = $request->input('birth_date');
                $reader = Reader::where('name', $name)->where('phone', $phone)->where('birth_date', $birth)->first();

                if(!$reader){
                    $reader = Reader::where('reader_id', $id)->first();
                    $reader->name = $name;
                    $reader->phone = $phone;
                    $reader->birth_date = $birth;
                    $reader->save();
                }

                return redirect()->route('Reader');
                break;

            case 'Library_card':
                $reader_id = $request->input('reader_id');
                $book_id = $request->input('book_id');

                $story = Library_card::where('id', $id)->first();
                $story->reader_id = $reader_id;
                $story->book_id = $book_id;
                $story->save();

                return redirect()->route('Library_card');
                break;

            default:
                return redirect()->route('Library_card');
                break;

        }
    }

    public function Delete(Request $request) {

        $previousUrl = $request->headers->get('referer');
        $type = rtrim(substr($previousUrl, strrpos($previousUrl, '/') + 1), '/');
        $id = $request->input('id');

        switch($type){
            case 'Author':
                $author = Author::where('author_id', $id)->first();

                try {
                    $author->delete();
                } catch (\Exception $e) {
                    return redirect()->route('error');
                }

                return redirect()->route('Author');
                break;

            case 'Book':
                $book = Book::where('book_id', $id)->first();

                try {
                    $book->delete();
                } catch (\Exception $e) {
                    return redirect()->route('error');
                }

                return redirect()->route('Book');
                break;

            case 'Genre':
                $genre = Genre::where('genre_id', $id)->first();

                try {
                    $genre->delete();
                } catch (\Exception $e) {
                    return redirect()->route('error');
                }

                return redirect()->route('Genre');
                break;

            case 'Reader':
                $reader = Reader::where('reader_id', $id)->first();

                try {
                    $reader->delete();
                } catch (\Exception $e) {
                    return redirect()->route('error');
                }

                return redirect()->route('Reader');
                break;

            case 'Library_card':
                $story = Library_card::where('id', $id)->first();

                try {
                    $story->delete();
                } catch (\Exception $e) {
                    return redirect()->route('error');
                }

                return redirect()->route('Library_card');
                break;

            default:
                return redirect()->route('Library_card');
        }
    }
}