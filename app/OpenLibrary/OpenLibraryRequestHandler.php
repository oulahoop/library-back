<?php

namespace App\OpenLibrary;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OpenLibraryRequestHandler
{

    private Client $client;

    private string $baseUri = 'https://openlibrary.org';

    /**
     * Instantiate a new RequestHandler
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'redirect.disable' => true
        ]);
    }

    /**
     * Make a request with this request handler
     *
     * @param string $path the path to hit
     * @param array $options the array of params
     *
     * @return ResponseInterface response object
     * @throws GuzzleException
     */
    public function request(string $path, array $options): ResponseInterface
    {
        $options = $options ?: array();
        $request = $this->client->request(
            'GET',
            $this->baseUri.$path.'?'.http_build_query($options),
            ['headers' => $this->getHeaders()]
        );

        return $request;
    }

    private function getHeaders()
    {
        return [
            'User-Agent' => 'OpenLibraryClient',
            'Accept' => 'application/json'
        ];
    }
}
