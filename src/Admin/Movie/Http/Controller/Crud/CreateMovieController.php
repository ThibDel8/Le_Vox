<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller\Crud;

use App\Admin\Movie\Domain\Handler\CreateMovieHandler;
use App\Admin\Movie\Domain\QueryHandler\CreateMovieQuery;
use App\Admin\Movie\Http\Form\CreateMovieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

final class CreateMovieController extends AbstractController
{
    public function __construct(
        private readonly CreateMovieQuery $createMovieQuery,
        private readonly CreateMovieHandler $createMovieHandler,
    ) {
    }

    #[Route(
        path: '/backstage-admin/movies/create/{id}',
        name: 'admin_movie_create',
        methods: [Request::METHOD_GET, Request::METHOD_POST],
    )]
    public function __invoke(int $id, Request $request): Response
    {
        $this->denyAccessUnlessGranted(AuthenticatedVoter::IS_AUTHENTICATED_FULLY);

        $createMovieRequest = $this->createMovieQuery->fetch(apiId: $id);

        $form = $this->createForm(type: CreateMovieType::class, data: $createMovieRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->createMovieHandler->handle(request: $form->getData());

            $this->addFlash('success', 'Le film a bien été ajouté.');

            return $this->redirectToRoute('admin_movie_list');
        }

        return $this->render(
            view: 'admin/movie/crud/create.html.twig',
            parameters: [
                'form' => $form,
            ]
        );
    }
}
