<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller;

use App\Admin\Movie\Domain\DTO\Request\SearchMovieRequest;
use App\Admin\Movie\Domain\QueryHandler\SearchMovieQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

#[AsController]
final class SearchMovieController extends AbstractController
{
    public function __construct(
        private readonly SearchMovieQuery $searchMovieQuery,
    ) {
    }

    #[Route(path: '/backstage-admin/movies/search', name: 'admin_movie_search', methods: [Request::METHOD_GET])]
    public function __invoke(
        #[MapQueryString] SearchMovieRequest $searchMovieRequest,
    ): Response {
        $this->denyAccessUnlessGranted(AuthenticatedVoter::IS_AUTHENTICATED_FULLY);

        $movies = $this->searchMovieQuery->fetch(request: $searchMovieRequest);

        return $this->render(
            view: 'admin/movie/search.html.twig',
            parameters: [
                'movies' => $movies,
        ]);
    }
}
