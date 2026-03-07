<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\DTO\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

readonly class SearchMovieRequest
{
    public function __construct(
        #[Assert\NotBlank]
        private ?string $title = null,
    ) {
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->query->get('query'),
        );
    }
}
