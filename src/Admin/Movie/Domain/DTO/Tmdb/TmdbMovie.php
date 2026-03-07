<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\DTO\Tmdb;

use App\Admin\Movie\Infrastructure\Tmdb\TmdbService;

readonly class TmdbMovie
{
    public function __construct(
        private int $id,
        private string $title,
        private ?string $description,
        private ?string $poster,
        private array $genres,
        private string $releaseDate,
        private float $voteAverage,
        private int $voteCount,
        private string $homepage,
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

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public static function fromApiResponse(array $apiMovie): self
    {
        return new self(
            id: $apiMovie['id'],
            title: $apiMovie['title'],
            description: $apiMovie['overview'],
            poster: $apiMovie['poster_path'] ? TmdbService::BASE_URL_IMAGE.$apiMovie['poster_path'] : null,
            genres:  array_column($apiMovie['genres'], 'name'),
            releaseDate: new \DateTimeImmutable($apiMovie['release_date'])->format('d/m/Y'),
            voteAverage: $apiMovie['vote_average'],
            voteCount: $apiMovie['vote_count'],
            homepage: $apiMovie['homepage'],
        );
    }
}
