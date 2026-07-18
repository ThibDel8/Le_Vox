<?php

declare(strict_types=1);

namespace App\Admin\Movie\Domain\DTO\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

readonly class SearchMovieRequest
{
    public function __construct(
        public ?string $title = null,
    ) {
    }
}
