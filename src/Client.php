<?php

namespace Wielski\Kinopoisk;

use Wielski\Kinopoisk\Support\HttpClient;

/**
 * Class Client
 * @package Wielski\Kinopois
 */
class Client
{
    /**
     * @var HttpClient
     */
    private $client = null;

    /**
     * Client constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->client = new HttpClient($options);
    }
}
