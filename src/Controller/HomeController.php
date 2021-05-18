<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\BookAuthor;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index ()
    {

        $em = $this->getDoctrine()->getManager();
        
        $repAuteurLivre = $em->getRepository(BookAuthor::class);
        $auteurLivre = $repAuteurLivre->findAll();
        
        $reviewRepo = $em->getRepository(Review::class);
        $review = $reviewRepo->getLatestReviews();
        
        $vars = ['unAvis' => $review,
                'auteurEtLivre' => $auteurLivre];
        //dd($vars);
        // todo: idéalement, il faudrait join les tables book et author via BookAuthor

        return $this->render("home/index.html.twig", $vars);
    }
}
