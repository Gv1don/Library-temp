<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Author extends Migration
{
    public function up(): void
    {
        Schema::create('Author', function (Blueprint $table){
            $table->id('author_id');
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Author');
    }
};
