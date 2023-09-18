<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up(): void
    {
        Schema::create('Library_card', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamp('date');

            $table->foreign('reader_id')->references('reader_id')->on('Reader');
            $table->foreign('book_id')->references('book_id')->on('Book');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Library_card');
    }
};

