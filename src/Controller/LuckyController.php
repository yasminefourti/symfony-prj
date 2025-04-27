<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Connection; // on utilise DBAL pour requêter

class LuckyController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function hello(Connection $connection): Response
    {
        $users = $connection->fetchAllAssociative('SELECT * FROM user02');

        return $this->render('home.html.twig', [
            'users' => $users,
        ]);
    }
}

