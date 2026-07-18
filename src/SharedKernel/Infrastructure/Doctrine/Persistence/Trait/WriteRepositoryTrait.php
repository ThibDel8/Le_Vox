<?php

declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Doctrine\Persistence\Trait;

/**
 * IMPORTANT:
 * This trait MUST only be used in classes extending ServiceEntityRepository
 * because it relies on getEntityManager().
 */
trait WriteRepositoryTrait
{
    public function save(object $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(object $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function saveBulk(iterable $entities, int $batchSize = 50): void
    {
        $i = 0;

        foreach ($entities as $entity) {
            $this->getEntityManager()->persist($entity);
            ++$i;

            if (0 === $i % $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear();
            }
        }

        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    public function deleteBulk(iterable $entities, int $batchSize = 50): void
    {
        $i = 0;

        foreach ($entities as $entity) {
            $this->getEntityManager()->remove($entity);
            ++$i;

            if (0 === $i % $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear();
            }
        }

        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }
}
