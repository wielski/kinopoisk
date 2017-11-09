<?php

namespace Wielski\Kinopoisk\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Collection;
use Wielski\Kinopoisk\Exceptions\KinopoiskConnectException;

/**
 * Class HttpClient
 * @package Siqwell\Eagle
 */
class HttpClient extends Client
{
    /**
     * @var string
     */
    private $secret = '';

    /**
     * @var string
     */
    private $base_url = 'https://ext.kinopoisk.ru/ios/5.0.0/';

    /**
     * HttpClient constructor.
     *
     * @param string|null $secret
     * @param array       $config
     */
    public function __construct(string $secret = null, array $config = [])
    {
        if ($secret) {
            $this->secret = $secret;
        }

        $config = array_merge([
            'base_url' => $this->base_url,
            'headers' => [
                'device' => 'android',
                'Android-Api-Version' => '22',
                'countryID' =>  '2',
                'ClientId' =>  '55decdcf6d4cd1bcaa1b3856',
                'clientDate' => '03:12 07.11.2017',
                'cityID' => '1',
                'Image-Scale' => '3',
                'Cache-Control' => 'max-stale=0',
                'User-Agent' => 'Android client (5.1 / api22), ru.kinopoisk/4.2.1 (57)',
                'Host' => 'ext.kinopoisk.ru',
                'Connection' => 'Keep-Alive',
                'Accept-Encoding' => 'gzip'
            ]
        ], $config);

        parent::__construct($config);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $query
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws KinopoiskConnectException
     */
    public function request($method, $uri = '', array $query = [])
    {
        $uri = (string) (new Uri($uri))->withQuery(http_build_query($query));

        $timestamp = time() * 1000;
        $signature = $this->getSignature($uri, $timestamp);

        try {
            return parent::request($method, $uri, array_merge($query, [
                'headers' => [
                    'X-TIMESTAMP' => $timestamp,
                    'X-SIGNATURE', $signature
                ]
            ]));
        } catch (ConnectException $e) {
            throw new KinopoiskConnectException();
        }
    }

    /**
     * @param string $path
     * @param int    $timestamp
     *
     * @return string
     */
    protected function getSignature(string $path, int $timestamp): string
    {
        $url = parse_url($path);

        $path_segments = new Collection(explode('/', $url['path']));
        $path_segments = $path_segments->reject(function ($name) {
            return empty($name);
        })->implode('/');

        $urlQuery = $url['query'];

        $realPath = "$path_segments?$urlQuery";

        return md5($realPath . $timestamp . $this->secret);
    }
}
