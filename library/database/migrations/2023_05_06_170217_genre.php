<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Genre extends Migration
{
    public function up(): void
    {
        Schema::create('Genre', function (Blueprint $table) {
            $table->id('genre_id');
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Genre');
    }
};
