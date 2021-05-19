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
    $currentUser = $this->getUser();

    if($currentUser == null)
        {
            return $this->redirectToRoute('app_login');
        }
    else
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

    #[Route('/profil/edition', name: 'edition')]
    public function editProfile(): Response
    {
        
        return $this->render('profil/edition.html.twig');
    }

    #[Route('/profil/confirmer_edition', name: 'confirmation_edition')]
    public function confirmEdit(Request $req): Response
    {
        $user = $this->getUser();
        $login = $req->request->get('login');
        $firstName = $req->request->get('firstName');
        $lastName = $req->request->get('lastName');
        $email = $req->request->get('email');
        $birthday = new \DateTime($req->request->get('birthdate'));
        //dd([$user, $login, $firstName, $lastName, $email, $birthday]);

        $em = $this->getDoctrine()->getManager();
        $repUser = $em->getRepository(User::class);
        $userToChange = $repUser->findOneBy(['id' => $user]);
        
        $userToChange->setLogin($login);
        $userToChange->setFirstName($firstName);
        $userToChange->setLastName($lastName);
        $userToChange->setEmail($email);
        $userToChange->setBirthdate($birthday);
        $em->flush();
        
        return $this->redirectToRoute('profil');
    }
}
