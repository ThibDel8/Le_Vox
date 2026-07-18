<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\Handler;

use App\Admin\Movie\Domain\DTO\Request\CreateMovieRequest;
use App\Admin\Movie\Domain\DTO\Request\SearchMovieRequest;
use App\Admin\Movie\Domain\Entity\Movie;
use App\Admin\Movie\Domain\Repository\MovieWriteRepositoryInterface;
use DateTimeImmutable;

readonly class CreateMovieHandler
{
    public function __construct(
        private MovieWriteRepositoryInterface $movieWriteRepository,
    ) {
    }

    public function handle(CreateMovieRequest $request): void
    {
        $movie = Movie::create(
            title: $request->title,
            poster: $request->poster,
            description: $request->description,
            genres: $request->genres,
            directing: $request->directing,
            releaseDate: DateTimeImmutable::createFromFormat(
                format: 'd/m/Y',
                datetime: $request->releaseDate,
            ),
            voteAverage: $request->voteAverage,
            voteCount: $request->voteCount,
        );

        $this->movieWriteRepository->save($movie);
    }
}
