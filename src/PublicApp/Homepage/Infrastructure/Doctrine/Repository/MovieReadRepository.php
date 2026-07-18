<?php

declare(strict_types=1);

namespace App\PublicApp\Homepage\Infrastructure\Doctrine\Repository;

use App\Admin\Movie\Domain\Entity\Movie;
use App\PublicApp\Homepage\Domain\Repository\MovieReadRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

readonly class MovieReadRepository implements MovieReadRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {
    }

    public function findUpComingMovies(): array
    {
        return $this->createQueryBuilder()
//            ->where('movies.date >= :now')
//            ->setParameter('now', new \DateTime())
//            ->orderBy('movies.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    private function createQueryBuilder(): QueryBuilder
    {
        return $this->manager->getRepository(Movie::class)->createQueryBuilder(alias: 'movie');
    }
}
