<?php
namespace Wielski\Kinopoisk\Exceptions;

/**
 * Class BrokenJsonException
 * @package Wielski\Kinopoisk\Exceptions
 */
class BrokenJsonException extends KinopoiskClientException
{
    protected $message = 'JSON answer is broken';
}
