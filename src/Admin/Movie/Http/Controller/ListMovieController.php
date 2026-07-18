<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListMovieController extends AbstractController
{
    #[Route(path: '/backstage-admin/movies', name: 'admin_movie_list', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function __invoke(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/movie/list.html.twig');
    }
}
