<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Doctrine\Repository;

use App\Security\Domain\Entity\User;
use App\Security\Domain\Repository\UserReadRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class UserReadRepository implements UserReadRepositoryInterface
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }
    public function findByUsername(string $username): ?User
    {
        return $this->manager->getRepository(User::class)->findOneBy(['username' => $username]);
    }
}
