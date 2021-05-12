<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index ()
    {
        //test requête doctrine simple
        $em = $this->getDoctrine()->getManager();
        $repLivre = $em->getRepository(Book::class);
        $livre = $repLivre->findAll(); 
        //dd($livre);

        $repAuteur = $em->getRepository(Author::class);
        $auteur = $repAuteur->findAll();
        
        $em = $this->getDoctrine()->getManager();
        $reviewRepo = $em->getRepository(Review::class);
        $review = $reviewRepo->getLatestReviews();
        
        $vars = ['unLivre' => $livre,
                'unAuteur' => $auteur,
                'unAvis' => $review];
        //dd($vars);
        // todo: idéalement, il faudrait join les tables book et author via BookAuthor

        return $this->render("home/index.html.twig", $vars);
    }
}
