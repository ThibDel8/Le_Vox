<?php

declare(strict_types=1);

namespace App\Security\Domain\Repository;

use App\Security\Domain\Entity\User;

interface UserReadRepositoryInterface
{
    public function findByUsername(string $username): ?User;
}
