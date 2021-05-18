<?php

namespace App\Controller;

use App\Entity\User;
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
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    #[Route('/profil/{titre}/{status}', name: 'updateProfil')]
    public function addStatus(Request $req)
    {
        
    $titreLivre = $req->get("titre");
    $statutLivre = $req->get("status");
    
    $vars = ['toAdd' => [$titreLivre, $statutLivre]];
    return $this->render('profil/index.html.twig', $vars);
    }
}
