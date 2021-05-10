<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
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
        $livre = $repLivre->findOneBy(['id' => rand(0,25)]); //critère à changer
        //dd($livre);

        $repAuteur = $em->getRepository(Author::class);
        $auteur = $repAuteur->findOneBy(['id' => rand(0,25)]);
        $vars = ['unLivre' => $livre,
                'unAuteur' => $auteur];
        //dd($vars);
        // todo: idéalement, il faudrait join les tables book et author via BookAuthor
        
        //test querybuilder
        /* $id = rand(0,25);
            
        $em = $this->getDoctrine()->getManager();
        $livresRepo = $em->getRepository(Book::class);
        $livres = $livresRepo->getOneBookRandomly($id);
        $vars = ['unLivre' => $livres];
        // attention ! retour array !
        dd($livres); */
        
        return $this->render("home/index.html.twig", $vars);
    }
}
