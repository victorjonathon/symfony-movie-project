<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'movies')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Movie::class);
        $movies = $repository->findBy([], ['title'=>'ASC']);

        $movies = ['Welcome', 'Simba'];
          
        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
