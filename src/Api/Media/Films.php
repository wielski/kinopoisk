<?php
namespace Wielski\Kinopoisk\Api\Media;

use Illuminate\Support\Collection;
use Wielski\Kinopoisk\Api\AbstractApi;
use Wielski\Kinopoisk\Exceptions\KinopoiskClientException;

/**
 * Class Films
 * @package Wielski\Kinopoisk\Api\Media
 */
class Films extends AbstractApi
{
    /**
     * @param int $id
     *
     * @return Collection|null
     * @throws KinopoiskClientException
     */
    public function getFilm(int $id): ?Collection
    {
        try {
            $response = $this->get("getKPFilmDetailView", [
                'cityId' => 1,
                'still_limit' => 9,
                'filmID' => $id
            ]);
        } catch (\Exception $e) {
            throw new KinopoiskClientException('getFilm error: ' . $e->getMessage(), $e->getCode());
        }

        return new Collection($response);
    }
}
