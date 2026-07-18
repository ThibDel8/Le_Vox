<?php

declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Doctrine\Persistence;

use Doctrine\ORM\EntityManagerInterface;

final readonly class PersistenceManager
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {
    }

    public function save(object $entity, bool $flush = true): void
    {
        $this->manager->persist($entity);

        if ($flush) {
            $this->manager->flush();
        }
    }

    public function delete(object $entity, bool $flush = true): void
    {
        $this->manager->remove($entity);

        if ($flush) {
            $this->manager->flush();
        }
    }

    public function flush(): void
    {
        $this->manager->flush();
    }
}
