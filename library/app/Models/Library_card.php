<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library_card extends Model
{
    use HasFactory;

    protected $table = 'Library_card';

    protected $fillable = [
        'reader_id',
        'book_id',
        'date',
    ];

    public $timestamps = false;
}
