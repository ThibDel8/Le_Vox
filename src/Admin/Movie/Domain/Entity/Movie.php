<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'movies')]
class Movie
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $poster;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $genres;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $directing;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, length: 255, nullable: true)]
    private ?\DateTimeImmutable $releaseDate;

    #[ORM\Column(type: Types::FLOAT, length: 255, nullable: true)]
    private ?float $voteAverage;

    #[ORM\Column(type: Types::INTEGER, length: 255, nullable: true)]
    private ?int $voteCount;

    private function __construct(
        string $title,
        ?string $description,
        ?string $poster,
        ?string $genres,
        ?string $directing,
        ?\DateTimeImmutable $releaseDate,
        ?float $voteAverage,
        ?int $voteCount,
        ?Uuid $id,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->poster = $poster;
        $this->genres = $genres;
        $this->directing = $directing;
        $this->releaseDate = $releaseDate;
        $this->voteAverage = $voteAverage;
        $this->voteCount = $voteCount;

        $this->id = $id ?? Uuid::v7();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function getDirecting(): ?string
    {
        return $this->directing;
    }

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public static function create(
        string $title,
        ?string $poster,
        ?string $description = null,
        ?string $genres = null,
        ?string $directing = null,
        ?\DateTimeImmutable $releaseDate = null,
        ?float $voteAverage = null,
        ?int $voteCount = null,
        ?string $id = null,
    ): self {
        return new self(
            title: $title,
            description: $description,
            poster: $poster,
            genres: $genres,
            directing: $directing,
            releaseDate: $releaseDate,
            voteAverage: $voteAverage,
            voteCount: $voteCount,
            id: $id ? Uuid::fromString($id) : null,
        );
    }
}
