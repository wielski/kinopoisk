<?php
namespace Wielski\Kinopoisk\Exceptions;

/**
 * Class KinopoiskConnectException
 * @package Wielski\Kinopoisk\Exceptions
 */
class KinopoiskConnectException extends KinopoiskClientException
{
    protected $message = 'Connection error';
}
