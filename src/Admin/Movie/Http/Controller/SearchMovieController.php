<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller;

use App\Admin\Movie\Domain\DTO\Request\SearchMovieRequest;
use App\Admin\Movie\Domain\QueryHandler\SearchMovieQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchMovieController extends AbstractController
{
    public function __construct(private readonly SearchMovieQuery $searchMovieQuery)
    {
    }

    #[Route(path: '/backstage-admin/movies/search', name: 'admin_movie_search', methods: [Request::METHOD_GET])]
    public function __invoke(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchMovieRequest = SearchMovieRequest::fromRequest($request);

        $movies = $this->searchMovieQuery->fetch($searchMovieRequest);

        return $this->render('admin/movie/search.html.twig', [
            'movies' => $movies,
        ]);
    }
}
