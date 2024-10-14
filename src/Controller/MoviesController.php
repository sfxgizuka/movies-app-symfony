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
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/movies', name: 'app_movies', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        //findAll ==> select * from movies
        //find ==> select * from movies where id = 5
        //findBy ==> select * from movies order by id desc;
        //findOneBy ==> select * from movies where id = 5
        $movieRepository = $this->em->getRepository(Movie::class);
        $movies = $movieRepository->findOneBy(['id'=>5, 'title'=>'aki and paw paw'], ['id' => 'DESC']);
        dd($movies);
        return $this->render('index.html.twig');
    }
}
