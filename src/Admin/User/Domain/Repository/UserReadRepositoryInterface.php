<?php

declare(strict_types=1);

namespace App\Admin\User\Domain\Repository;

use App\Admin\User\Domain\Entity\User;

interface UserReadRepositoryInterface
{
    public function findByUsername(string $username): ?User;
}
