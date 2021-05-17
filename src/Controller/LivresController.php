<?php

namespace App\Controller;

use App\Entity\Audience;
use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Review;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'livres')]
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $repLivre = $em->getRepository(Book::class);
        $livre = $repLivre->findAll(); 

        $repAuteur = $em->getRepository(Author::class);
        $auteurs = $repAuteur->findAll(); 

        $repGenre = $em->getRepository(Category::class);
        $category = $repGenre->findAll(); 

        $repAudience = $em->getRepository(Audience::class);
        $audience = $repAudience->findAll();
        
        $repReview = $em->getRepository(Review::class);
        $reviews = $repReview->findAll();

        $vars = ['livres' => $livre,
                'auteurs' => $auteurs,
                'categories' => $category,
                'audience' => $audience,
                'reviews' => $reviews];

        return $this->render("livres/index.html.twig", $vars);
    }
}
