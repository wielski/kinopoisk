<?php

namespace Wielski\Kinopoisk;

use Wielski\Kinopoisk\Api\Media\Films;
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

    /**
     * @return Films
     */
    public function films(): Films
    {
        return new Films($this->client);
    }
}
