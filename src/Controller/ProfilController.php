<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\UserBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(): Response
    {
        $currentUser = $this->getUser();

        if($currentUser == null)
        {
            return $this->redirectToRoute('app_login');
        }
        else

        $em = $this->getDoctrine()->getManager();
        $rUb = $em->getRepository(UserBook::class);
        $ub = $rUb->findAll();
    
        $vars = ['infosUserBook' => $ub];

        return $this->render('profil/index.html.twig', $vars);
    }

    #[Route('/profil/{id}/{status}', name: 'updateProfil')]
    public function addStatus(Request $req)
    {
        
    $idLivre = $req->get("id");
    $statutLivre = $req->get("status");

    $user = $this->getUser();
    $em = $this->getDoctrine()->getManager();
    $repLivre = $em->getRepository(Book::class);
    $book = $repLivre->findOneBy(array("id" =>$idLivre));

    //enregistrement dans la db
    $userBook = new UserBook();
    $userBook->setReadingStatus($statutLivre);
    $userBook->setIdUser($user);
    $userBook->setIdBook($book);
    $em->persist($userBook);
    $em->flush();

    $em = $this->getDoctrine()->getManager();
        $rUb = $em->getRepository(UserBook::class);
        $ub = $rUb->findAll();
    
        $vars = ['infosUserBook' => $ub];

    return $this->render('profil/index.html.twig', $vars);
    }
}
