<?php

declare(strict_types=1);

namespace App\PublicApp\Homepage\Domain\QueryHandler;

use App\PublicApp\Homepage\Domain\Repository\MovieReadRepositoryInterface;

readonly class ListMovieQuery
{
    public function __construct(
        private MovieReadRepositoryInterface $movieReadRepository,
    ) {
    }

    public function fetch(): array
    {
        return $this->movieReadRepository->findUpcomingMovies();
    }
}
