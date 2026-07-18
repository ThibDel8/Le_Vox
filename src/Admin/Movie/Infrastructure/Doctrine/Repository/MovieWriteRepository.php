<?php

declare(strict_types=1);

namespace App\Admin\Movie\Infrastructure\Doctrine\Repository;

use App\Admin\Movie\Domain\Repository\MovieWriteRepositoryInterface;
use App\Admin\User\Domain\Entity\User;
use App\SharedKernel\Infrastructure\Doctrine\Persistence\PersistenceManager;
use App\SharedKernel\Infrastructure\Doctrine\Persistence\Trait\WriteRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieWriteRepository extends ServiceEntityRepository implements MovieWriteRepositoryInterface
{
    use WriteRepositoryTrait;

    public function __construct(
        ManagerRegistry $registry,
        private readonly PersistenceManager $persistence,
    ) {
        parent::__construct($registry, User::class);
    }
}
