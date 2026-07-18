<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Movie
{
    private Uuid $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title;

    private function __construct(
        string $title,
    ) {
        $this->title = $title;
        $this->id = Uuid::v7();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function create(
        string $title,
    ): self {
        return new self(
            title: $title,
        );
    }
}
