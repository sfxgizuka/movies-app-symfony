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
        $movies = ['Aki & Paw Paw', 'The Shawshank Redemption', 'The Godfather', 'The Godfather: Part II', 'The Dark Knight', '12 Angry Men', 'Schindler\'s List', 'The Lord of the Rings: The Return of the King', 'Pulp Fiction', 'The Good, the Bad and the Ugly', 'The Lord of the Rings: The Fellowship of the Ring'];
        return $this->render('index.html.twig', array('movies' => $movies));
    }
}
