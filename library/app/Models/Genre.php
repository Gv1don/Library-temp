<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    use HasFactory;

    protected $table = 'Genre';

    protected $primaryKey = 'genre_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}