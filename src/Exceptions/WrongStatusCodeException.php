<?php
namespace Wielski\Kinopoisk\Exceptions;

/**
 * Class WrongStatusCodeException
 * @package Wielski\Kinopoisk\Exceptions
 */
class WrongStatusCodeException extends KinopoiskClientException
{
    protected $message = 'Response status code is not 200';
}
