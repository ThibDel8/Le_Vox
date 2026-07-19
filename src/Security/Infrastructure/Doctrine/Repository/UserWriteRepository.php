<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Doctrine\Repository;

use App\Security\Domain\Entity\User;
use App\Security\Domain\Repository\UserWriteRepositoryInterface;
use App\SharedKernel\Infrastructure\Doctrine\Persistence\PersistenceManager;
use App\SharedKernel\Infrastructure\Doctrine\Persistence\Trait\WriteRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserWriteRepository extends ServiceEntityRepository implements UserWriteRepositoryInterface
{
    use WriteRepositoryTrait;

    public function __construct(
        ManagerRegistry $registry,
        private readonly PersistenceManager $persistence,
    ) {
        parent::__construct($registry, User::class);
    }
}
