<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';

    protected $primaryKey = 'id';
    protected $fillable = ['title', 'author_key', 'first_publish_year', 'rating_average', 'rating_sortable', 'cover'];

    public function subjects()
    {
        return $this->hasMany(BookSubject::class, 'book_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_key', 'key');
    }

    public function isbn()
    {
        return $this->hasOne(ISBN::class);
    }
}
