<?php

declare(strict_types=1);

namespace App\Admin\Movie\Infrastructure\Tmdb;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TmdbService
{
    private const string BASE_URL = 'https://api.themoviedb.org/3';
    public const string BASE_URL_IMAGE  ='https://image.tmdb.org/t/p/w500';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $tmdbApiKey
    ) {
    }


    /**
     * Recherche de films par titre
     */
    public function searchMoviesByTitle(
        string $title,
        bool $includeAdult = true,
        string $language = 'fr-FR',
        int $page = 1,
        ?string $primaryReleaseYear = null,
        ?string $region = null,
        ?string $year = null,
    ): array {
        return $this->httpClient->request(
            method: Request::METHOD_GET,
            url: self::BASE_URL.'/search/movie',
            options: [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->tmdbApiKey,
                    'accept' => 'application/json',
                ],
                'query' => [
                    'query' => $title,
                    'include_adult' => $includeAdult,
                    'language' => $language,
                    'primary_release_year' => $primaryReleaseYear,
                    'page' => $page,
                    'region' => $region,
                    'year' => $year,
                ],
            ],
        )->toArray()['results'] ?? [];
    }


    /**
     * Récupère les détails d’un film avec les crédits
     */
    public function getMovieDetailsWithCredits(
        int $movieId,
        string $language = 'fr-FR',
        string $appendToResponse = 'credits',
    ): array {
        return $this->httpClient->request(
            method: Request::METHOD_GET,
            url: self::BASE_URL.'/movie/'.$movieId,
            options: [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->tmdbApiKey,
                    'accept' => 'application/json',
                ],
                'query' => [
                    'language' => $language,
                    'append_to_response' => $appendToResponse
                ]
            ]
        )->toArray();
    }


    /**
     * Récupère la liste des genres
     */
    public function getGenres(string $language = 'fr-FR'): array
    {
        $response = $this->httpClient->request(
            method: Request::METHOD_GET,
            url: self::BASE_URL.'/genre/movie/list',
            options: [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->tmdbApiKey,
                    'accept' => 'application/json',
                ],
                'query' => [
                    'language' => $language,
                ]
            ],
        );

        return $response->toArray()['genres'] ?? [];
    }
}
