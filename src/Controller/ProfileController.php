<?php
// src/Controller/ProfileController.php

// src/Controller/ProfileController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('ROLE_USER')) {
            // Utilisateur non authentifié, on le redirige vers la page de login
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/index.html.twig');
    }
}

