<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPages extends AbstractController
{
    // Route pour l'accueil
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil.html.twig');
    }

    // Route pour la connexion
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }

    // Route pour le tableau de bord de l'admin
    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('admin.html.twig', [
            'titre' => 'TABLEAU DE BORD DE L\'ADMINISTRATEUR'
        ]);
    }
}
