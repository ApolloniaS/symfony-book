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
        
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Book::class);

        $livre = $rep->findOneBy(['id' => rand(176,200)]);
        //dd($livre);

        $vars = ['unLivre' => $livre];

        return $this->render("home/index.html.twig", $vars);
    }
}
