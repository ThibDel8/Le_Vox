<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\QueryHandler;

use App\Admin\Movie\Domain\DTO\Response\MovieResponse;
use App\Admin\Movie\Infrastructure\Tmdb\TmdbService;

readonly class CreateMovieQuery
{
    public function __construct(private TmdbService $tmdbService)
    {
    }

    public function fetch(int $id): MovieResponse
    {
        $result = $this->tmdbService->getMovieDetailsWithCredits($id);

        $details = $this->tmdbService->getMovieDetailsWithCredits($result['id']);

        $directors = [];
        foreach ($details['credits']['crew'] ?? [] as $crewMember) {
            if ($crewMember['job'] === 'Director') {
                $directors[] = $crewMember['name'];
            }
        }

        $directorString = $directors ? implode(', ', $directors) : null;

        $resultGenres = [];
        foreach ($result['genres'] as $genre) {
            $resultGenres[] = $genre['name'];
        }

        $genresString = $resultGenres ? implode(', ', $resultGenres) : '';

        return MovieResponse::fromApiResponse(
            movie: $details,
            genresString: $genresString,
            directorString: $directorString,
        );
    }
}
