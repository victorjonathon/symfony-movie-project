<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;
use App\Form\MovieFormType;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'movies', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Movie::class);
        $movies = $repository->findBy([], ['releaseYear'=>'DESC']);
          
        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/create', name: 'create_movie')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);
       
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newMovie = $form->getData();
            $imagePath = $form->get('imagePath')->getData();
            if ($imagePath) {
                $newFileName = uniqid().'.'.$imagePath->guessExtension();
                try {
                    $imagePath->move(
                        'uploads/movie_images',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $movie->setImagePath('uploads/movie_images/'.$newFileName);
            }

            $em->getRepository(Movie::class);
            $em->persist($movie);
            $em->flush();
            return $this->redirectToRoute('movies');
        }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/movies/{id}', name: 'show_movie', methods: ['GET'])]
    public function show($id, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Movie::class);
        $movie = $repository->find($id);
        return $this->render('movies/show.html.twig', [
            'movie' => $movie
        ]);
    }

    
}
