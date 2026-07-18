<?php

declare(strict_types=1);

namespace App\Admin\Movie\Infrastructure\Doctrine\Repository;

use App\Admin\Movie\Domain\Entity\Movie;
use App\Admin\Movie\Domain\Repository\MovieReadRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

readonly class MovieReadRepository implements MovieReadRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {
    }

    public function findAllMovies(): array
    {
        return $this->createQueryBuilder()
            ->orderBy('movie.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    private function createQueryBuilder(): QueryBuilder
    {
        return $this->manager->getRepository(Movie::class)->createQueryBuilder(alias: 'movie');
    }
}
