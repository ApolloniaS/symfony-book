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
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/livres/review/{id}', name: 'writeReview')]
    public function writeReview(Request $req)
    {
        $idLivre = $req->get('id');

        $em = $this->getDoctrine()->getManager();
        $repLivre = $em->getRepository(Book::class);
        $livre = $repLivre->findOneBy(['id' => $idLivre]);

        $vars = ['leLivre' => $livre];

        return $this->render("livres/review.html.twig", $vars);

    }

    #[Route('/livres/submit/{id}', name: 'submitReview')]
    public function submitReview(Request $req){

        $idLivre = $req->get('id');
        $score = $req->request->get('score');
        $avis = $req->request->get('message');
        $today = new \DateTime();

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repBook = $em->getRepository(Book::class);
        $book = $repBook->findOneBy(array("id" =>$idLivre));

        //enregistrement dans la db
        $review = new Review();
        $review->setIdUser($user);
        $review->setIdBook($book);
        $review->setReviewDate($today);
        $review->setReviewContent($avis);
        $review->setReviewScore($score);
        $em->persist($review);
        $em->flush(); 

        return $this->redirectToRoute('home');
    }

    #[Route('/livres/read/{id}', name: 'readReview')]
    public function readReview(Request $req){

        $idLivre = $req->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $repReview = $em->getRepository(Review::class);
        $review = $repReview->findBy(['idBook' => $idLivre]);

        $repLivre = $em->getRepository(Book::class);
        $livre = $repLivre->findOneBy(['id' => $idLivre]);
        

        $vars = ['avis' => $review,
                'livre' => $livre];


        return $this->render("livres/allreviews.html.twig", $vars);
    
    }

}
