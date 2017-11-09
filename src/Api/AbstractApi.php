<?php

namespace Wielski\Kinopoisk\Api;

use Psr\Http\Message\ResponseInterface;
use Wielski\Kinopoisk\Contracts\ApiInterface;
use Wielski\Kinopoisk\Exceptions\BrokenJsonException;
use Wielski\Kinopoisk\Exceptions\KinopoiskClientException;
use Wielski\Kinopoisk\Exceptions\ResponseEmptyException;
use Wielski\Kinopoisk\Exceptions\WrongStatusCodeException;
use Wielski\Kinopoisk\Support\HttpClient;

/**
 * Class AbstractApi
 * @package Wielski\Kinopoisk\Api
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * AbstractApi constructor.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param       $path
     * @param array $parameters
     *
     * @return mixed
     */
    protected function get($path, array $parameters = [])
    {
        return $this->request('get', $path, $parameters);
    }

    /**
     * @param      $path
     * @param null $postBody
     *
     * @return mixed
     */
    protected function post($path, $postBody = null)
    {
        return $this->request('post', $path, $postBody);
    }

    /**
     * @param $method
     * @param $path
     * @param $opts
     *
     * @return mixed
     */
    protected function request($method, $path, $opts)
    {
        $response = $this->client->request($method, $path, $opts);

        return $this->decodeResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return mixed
     * @throws BrokenJsonException
     * @throws KinopoiskClientException
     * @throws ResponseEmptyException
     * @throws WrongStatusCodeException
     */
    private function decodeResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new WrongStatusCodeException();
        }

        if (!$result = $response->getBody()->getContents()) {
            throw new ResponseEmptyException();
        }

        try {
            $json = \GuzzleHttp\json_decode($result);
        } catch (\InvalidArgumentException $e) {
            throw new BrokenJsonException();
        }

        if ($json->status != 200) {
            throw new KinopoiskClientException(implode(', ', $json->errors));
        }

        return $json->data;
    }
}
