<?php

namespace App\OpenLibrary;


use Psr\Http\Message\ResponseInterface;

class OpenLibraryClient
{
    private OpenLibraryRequestHandler $requestHandler;

    public function __construct()
    {
        $this->requestHandler = new OpenLibraryRequestHandler();
    }

    private function makeRequest(string $path, array $options = []): object
    {
        $request = $this->requestHandler->request($path, $options);

        return $this->parseResponse($request);
    }

    private function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody());
    }

    public function queryBooks($query)
    {
        $query = str_replace(' ', '+', $query);
        return $this->makeRequest('/search.json', ['q' => $query]);
    }

    public function queryBooksByTitle($title)
    {
        return $this->makeRequest('/search.json', ['title' => $title]);
    }

    public function queryBooksByAuthor($author)
    {
        return $this->makeRequest('/search.json', ['author' => $author]);
    }

    public function queryBooksByISBN($isbn)
    {
        return $this->makeRequest('/search.json', ['isbn' => $isbn]);
    }
}
