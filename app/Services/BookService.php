<?php

namespace App\Services;

use App\Models\Authors;
use App\Models\Books;
use App\Models\BookSubject;
use stdClass;

class BookService
{

    public function __construct()
    {
        //
    }

    public function addBook(stdClass $apiData): Books {
        // Check if the book already exists in the database
        $book = Books::where('title', $apiData->title)->first();

        if ($book) {
            return $book;
        }

        // Add Author to the database
        $author = Authors::where('key', $apiData->author_key[0])->first();
        if (!$author) {
            $author = new Authors();
            $author->key = $apiData->author_key[0];
            $author->name = $apiData->author_name[0];
            $author->save();
        }

        // If the book does not exist, create a new record with everything from the API
        $book = new Books();
        $book->title = $apiData->title;
        $book->author_key = $apiData->author_key[0]; // Just get the first author for now
        $book->first_publish_year = $apiData->first_publish_year;
        $book->rating_average = $apiData->ratings_average ?? 0;
        $book->rating_sortable = $apiData->ratings_sortable ?? 0;
        $book->cover = $apiData->cover_i ?? null;

        $book->save();

        // Add subjects to the database
        if(!isset($apiData->subject)) {
            return $book;
        }

        foreach ($apiData->subject as $subject) {
            $bookSubject = new BookSubject();
            $bookSubject->book_id = $book->id;
            $bookSubject->subject = $subject;
            $bookSubject->save();
        }

        return $book;
    }

    public function getBooks()
    {
        return Books::all()->load('subjects', 'author');
    }
}
