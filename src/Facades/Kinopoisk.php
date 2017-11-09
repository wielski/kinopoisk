<?php
namespace Wielski\Kinopoisk\Facades;

use Illuminate\Support\Facades\Facade;
use Wielski\Kinopoisk\Api\Media\Films;

/**
 * Class Kinopoisk
 * @package Wielski\Kinopoisk\Facades
 * @method static Films films()
 */
class Kinopoisk extends Facade
{
    /**
     * Kinopoisk facade accessor
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'kinopoisk';
    }
}
