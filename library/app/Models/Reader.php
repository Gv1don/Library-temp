<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reader extends Model
{
    use HasFactory;

    protected $table = 'Reader';

    protected $primaryKey = 'reader_id';

    protected $fillable = [
        'name',
        'phone',
        'bith_date',
    ];

    public $timestamps = false;
}
