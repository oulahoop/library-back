<?php

namespace App\Services;

use OpenLibrary\API\Client as OpenLibraryAPI;

class BooksAPI {

    private $api;

    public function __construct()
    {
        $this->api = new OpenLibraryAPI();
    }

    public function searchBooks($query) {
        return $this->api->query($query);
    }
}
