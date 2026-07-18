<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\QueryHandler;

use App\Admin\Movie\Domain\DTO\Request\SearchMovieRequest;
use App\Admin\Movie\Domain\DTO\Response\MovieResponse;
use App\Admin\Movie\Infrastructure\Tmdb\TmdbService;

readonly class SearchMovieQuery
{
    public function __construct(private TmdbService $tmdbService)
    {
    }

    /**
     * @return MovieResponse[]
     */
    public function fetch(SearchMovieRequest $request): array
    {
        if (!$request->getTitle()) {
            return [];
        }

        $results = $this->tmdbService->searchMoviesByTitle($request->getTitle());
        $genres = $this->tmdbService->getGenres();

        $genreMap = [];
        foreach ($genres as $genre) {
            $genreMap[$genre['id']] = $genre['name'];
        }

        $responses = [];
        foreach ($results as $result) {
            $details = $this->tmdbService->getMovieDetailsWithCredits($result['id']);

            $directors = [];
            foreach ($details['credits']['crew'] ?? [] as $crewMember) {
                if ($crewMember['job'] === 'Director') {
                    $directors[] = $crewMember['name'];
                }
            }

            $directorString = $directors ? implode(', ', $directors) : null;

            $resultGenres = [];
            foreach ($result['genre_ids'] as $genreId) {
                if (isset($genreMap[$genreId])) {
                    $resultGenres[] = $genreMap[$genreId];
                }
            }

            $genresString = $resultGenres ? implode(', ', $resultGenres) : '';

            $responses[] = MovieResponse::fromApiResponse(
                movie: $details,
                genresString: $genresString,
                directorString: $directorString,
            );
        }

        return $responses;
    }
}
