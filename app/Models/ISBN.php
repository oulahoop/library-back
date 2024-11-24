<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISBN extends Model
{
    protected $table = 'isbn';
    protected $fillable = [
        'isbn',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
