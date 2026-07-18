<?php

declare(strict_types=1);

namespace App\PublicApp\Homepage\Http\Controller;

use App\PublicApp\Homepage\Domain\QueryHandler\ListMovieQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomepageController extends AbstractController
{
    public function __construct(
        private readonly ListMovieQuery $listMovieQuery,
    ) {
    }

    #[Route(path: '/', name: 'app_homepage', methods: [Request::METHOD_GET])]
    public function __invoke(): Response
    {
        $movies = $this->listMovieQuery->fetch();

        return $this->render(
            view: 'publicApp/homepage/index.html.twig',
            parameters: [
                'movies' => $movies,
            ],
        );
    }
}
