<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\QueryHandler;

use App\Admin\Movie\Domain\Repository\MovieReadRepositoryInterface;

readonly class ListMovieQuery
{
    public function __construct(
        private MovieReadRepositoryInterface $movieReadRepository,
    ) {
    }

    public function fetch(): array
    {
        return $this->movieReadRepository->findAllMovies();
    }
}
