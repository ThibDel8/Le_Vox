<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\DTO\Response;

use App\Admin\Movie\Infrastructure\Tmdb\TmdbService;

readonly class MovieResponse
{
    private const string UNKNOWN = '-';
    public function __construct(
        private int $id,
        private string $title,
        private ?string $description,
        private ?string $poster,
        private ?string $genres,
        private ?string $directing,
        private ?string $releaseDate,
        private ?float $voteAverage,
        private ?int $voteCount,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function getDirecting(): ?string
    {
        return $this->directing;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public static function fromApiResponse(array $movie, ?string $genresString, ?string $directorString): self
    {
        return new self(
            id: $movie['id'],
            title: $movie['title'],
            description: !empty($movie['overview']) ? $movie['overview'] : 'Pas de description.',
            poster: !empty($movie['poster_path']) ? TmdbService::BASE_URL_IMAGE.$movie['poster_path'] : null,
            genres: !empty($genresString) ? $genresString : self::UNKNOWN,
            directing: !empty($directorString) ? $directorString : self::UNKNOWN,
            releaseDate: $movie['release_date'] ? new \DateTimeImmutable($movie['release_date'])->format('d/m/Y') : self::UNKNOWN,
            voteAverage: $movie['vote_average'] ? (float)$movie['vote_average'] : 0,
            voteCount: $movie['vote_count'] ? (int)$movie['vote_count'] : 0,
        );
    }
}
