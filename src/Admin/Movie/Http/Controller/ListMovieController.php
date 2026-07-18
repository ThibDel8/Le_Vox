<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller;

use App\Admin\Movie\Domain\QueryHandler\ListMovieQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

final class ListMovieController extends AbstractController
{
    public function __construct(
        private readonly ListMovieQuery $listMovieQuery,
    ) {
    }
    #[Route(path: '/backstage-admin/movies', name: 'admin_movie_list', methods: [Request::METHOD_GET])]
    public function __invoke(Request $request): Response
    {
        $this->denyAccessUnlessGranted(AuthenticatedVoter::IS_AUTHENTICATED_FULLY);

        $movies = $this->listMovieQuery->fetch();

        return $this->render(
            view: 'admin/movie/list.html.twig',
            parameters: [
                'movies' => $movies,
            ],
        );
    }
}
