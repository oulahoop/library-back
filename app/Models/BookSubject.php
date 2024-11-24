<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubject extends Model
{
    protected $table = 'book_subject';
    protected $fillable = ['book_id', 'subject'];

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
