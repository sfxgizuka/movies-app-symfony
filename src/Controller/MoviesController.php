<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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
    private $em;
    public function __construct(MovieRepository $movieRepository, EntityManagerInterface $em){
        $this->movieRepository = $movieRepository;
        $this->em = $em;
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

    #[Route('/movies/create', name: 'create_movies')]
    public function create(Request $request): Response{
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newMovie = $form->getData();
            $imagePath = $form->get('imagePath')->getData();
            if($imagePath){
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                try{
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                }catch(FileException $e){
                    return new Response($e->getMessage());
                }
                $newMovie->setImagePath('/uploads/' . $newFileName);
            }
            $this->em->persist($newMovie);
            $this->em->flush();
            return $this->redirectToRoute('app_movies');

        }

        return $this->render('/movies/create.html.twig', [
            'form' => $form->createView()
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
