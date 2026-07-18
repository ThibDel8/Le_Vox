<?php

declare(strict_types=1);

namespace App\PublicApp\Homepage\Domain\Repository;

use App\Admin\Movie\Domain\Entity\Movie;

interface MovieReadRepositoryInterface
{
    /** @return Movie[] */
    public function findUpComingMovies(): array;
}
