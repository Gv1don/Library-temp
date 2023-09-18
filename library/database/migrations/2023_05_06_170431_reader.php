<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reader extends Migration
{
    public function up(): void
    {
        Schema::create('Reader', function (Blueprint $table) {
            $table->id('reader_id');
            $table->string('name');
            $table->string('phone');
            $table->date('birth_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Reader');
    }
};
