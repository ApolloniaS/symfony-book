<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        //test requête doctrine simple
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Book::class);
        $livre = $rep->findOneBy(['id' => rand(0,25)]); //critère à changer
        //dd($livre);
        $vars = ['unLivre' => $livre];

        //test querybuilder
       /*  $id = rand(0,25);
        $em = $this->getDoctrine()->getManager();
        $bookRepo = $em->getRepository(Book::class);
        $livres = $bookRepo->test($id);
        
        $vars = ['unLivre' => $livres]; */
        //dd($livres);

        return $this->render("home/index.html.twig", $vars);
    }
}
