<?php
namespace Wielski\Kinopoisk\Exceptions;

/**
 * Class ResponseEmptyException
 * @package Wielski\Kinopoisk\Exceptions
 */
class ResponseEmptyException extends KinopoiskClientException
{
    protected $message = 'Kinopoisk response is empty';
}
