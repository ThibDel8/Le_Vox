<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller\Crud;

use App\Admin\Movie\Domain\DTO\Request\SearchMovieRequest;
use App\Admin\Movie\Domain\Handler\CreateMovieHandler;
use App\Admin\Movie\Domain\QueryHandler\CreateMovieQuery;
use App\Admin\Movie\Http\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateMovieController extends AbstractController
{
    public function __construct(
        private readonly CreateMovieQuery $createMovieQuery,
        private readonly CreateMovieHandler $createMovieHandler,
    ) {
    }

    #[Route(path: '/backstage-admin/movies/create/{id}', name: 'admin_movie_create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function __invoke(int $id, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $movieResponse = $this->createMovieQuery->fetch($id);

        $form = $this->createForm(type: MovieType::class, data: $movieResponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movieRequest = SearchMovieRequest::fromRequest($request);

            $this->createMovieHandler->handle($movieRequest);

            $this->addFlash('success', 'Le film a bien été ajouté.');

            return $this->redirectToRoute('admin_movie_list');
        }

        return $this->render('admin/movie/crud/create.html.twig', [
            'form' => $form,
            'movieResponse' => $movieResponse,
        ]);
    }
}
