<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Book extends Migration
{
    public function up(): void
    {
        Schema::create('Book', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('title');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('genre');
            $table->integer('age_rating');

            $table->foreign('author')->references('author_id')->on('Author');
            $table->foreign('genre')->references('genre_id')->on('Genre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Book');
    }
};
