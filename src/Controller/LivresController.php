<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Entity\BookAuthor;
use App\Entity\Category;
use App\Entity\Review;
use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Data\SearchData;
use App\Form\SearchType;


class LivresController extends AbstractController
{
    #[Route('/livres', name: 'livres')]
    public function index(PaginatorInterface $paginator, Request $req): Response
    {

        $em = $this->getDoctrine()->getManager();

        $repLivreAuteur = $em->getRepository(BookAuthor::class);
        $livreAuteur = $repLivreAuteur->findAll(); 
        //partie qui gère la pagination
        $numeroPage = $req->query->getInt('page', 1);
        $paginationLivres = $paginator->paginate(
            $livreAuteur,
            $numeroPage,
            5 // résultats affichés par page
        );

        $repGenre = $em->getRepository(Category::class);
        $category = $repGenre->findAll(); 
        
        $repReview = $em->getRepository(Review::class);
        $reviews = $repReview->findAll();
        
        //$nb = $repReview->countReviewsForOneBook($id);
        //todo: check moyen de récup l'id du livre
        
        
        $vars = ['livreEtAuteur' => $livreAuteur,
                'categories' => $category,
                'reviews' => $reviews,
                'paginationLivres' => $paginationLivres,
                ];
        //TODO: quand la fixture categories fonctionnera, retirer le random
        //TODO: faire moyenne des scores et enlever le random
        //dd($vars);
        return $this->render("livres/index.html.twig", $vars);
    }

    #[Route('/livres/review/{id}', name: 'writeReview')]
    public function writeReview(Request $req)
    {
        $currentUser = $this->getUser();
        if($currentUser == null)
        {
            return $this->redirectToRoute('app_login');
        }
        else
        {
        $idLivre = $req->get('id');

        $em = $this->getDoctrine()->getManager();
        $repLivre = $em->getRepository(Book::class);
        $livre = $repLivre->findOneBy(['id' => $idLivre]);

        $vars = ['leLivre' => $livre];

        return $this->render("livres/review.html.twig", $vars);
        }

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

    #[Route('/livres/results', name: 'results')]
    public function getResults(BookRepository $bookrep, Request $req): Response
    {
        //test filtre
        $data = new SearchData(); 
        $form = $this->createForm(
            SearchType::class,
            $data
        );
        $form->handleRequest($req);
        $livresfiltre = [];
        if ($form->isSubmitted()) {
            
            $livresfiltre = $bookrep->obtenirResultatsFiltres($data);
        } else {
            $livresfiltre = $bookrep->obtenirResultatsFiltres($data);
        }
        
        $vars = ['livresFiltre' => $livresfiltre,
                'form' => $form->createView()];

        return $this->render("livres/resultats.html.twig", $vars);
    }

}
