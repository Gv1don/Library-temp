<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $table = 'Book';

    protected $primaryKey = 'book_id';

    protected $fillable = [
        'title',
        'author',
        'genre',
        'age_rating',
    ];

    public $timestamps = false;

}
