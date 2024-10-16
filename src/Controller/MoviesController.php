<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class MoviesController extends AbstractController
// {
//     #[Route('/movies', name: 'app_movies', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
//     public function index(MovieRepository $movieRepository): Response
//     {
//         $movies = $movieRepository->findAll();
//         dd($movies);
//         return $this->render('index.html.twig');
//     }
// }
{
    private $movieRepository;
    public function __construct(MovieRepository $movieRepository){
        $this->movieRepository = $movieRepository;
    }
    #[Route('/movies', methods: ['GET'], name: 'app_movies')]
    public function index(): Response
    {
        //findAll ==> select * from movies
        //find ==> select * from movies where id = 5
        //findBy ==> select * from movies order by id desc;
        //findOneBy ==> select * from movies where id = 5
        return $this->render('movies/index.html.twig', [
            'movies' => $this->movieRepository->findAll(),
        ]);
    }

    #[Route('/movies/{id}', methods: ['GET'], name: 'show_movies')]
    public function show($id): Response
    {
        return $this->render('movies/show.html.twig', [
            'movie' => $this->movieRepository->find($id),
        ]);
    }
}
