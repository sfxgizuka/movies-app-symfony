<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'title' => 'Marvel Movies'
        ]);
    }
}
