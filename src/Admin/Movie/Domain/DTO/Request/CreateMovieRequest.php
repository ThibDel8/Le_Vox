<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\DTO\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateMovieRequest
{
    public function __construct(
        public ?int $apiId = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $poster = null,
        public ?string $genres = null,
        public ?string $directing = null,
        public ?string $releaseDate = null,
        public ?float $voteAverage = null,
        public ?int $voteCount = null,
    ) {
    }

    public static function create(
        int $apiId,
        string $title,
        string $description,
        string $poster,
        string $genres,
        string $directing,
        string $releaseDate,
        float $voteAverage,
        int $voteCount,
    ): self {
        return new self(
            apiId: $apiId,
            title: $title,
            description: $description,
            poster: $poster,
            genres: $genres,
            directing: $directing,
            releaseDate: $releaseDate,
            voteAverage: $voteAverage,
            voteCount: $voteCount,
        );
    }
}
