<?php

namespace App\Http\Controllers;

use App\OpenLibrary\OpenLibraryClient;
use App\Services\BookService;

class BooksController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function getBooks()
    {
        $books = $this->bookService->getBooks();

        return response()->json($books);
    }

    public function searchBooks()
    {
        $query = request('query');
        $openLibrary = new OpenLibraryClient();

        $result = $openLibrary->queryBooks($query);

        $books = [];

        foreach ($result->docs as $book) {
            $book = $this->bookService->addBook($book);
            $books[] = $book;
        }

        return response()->json($books);
    }
}
