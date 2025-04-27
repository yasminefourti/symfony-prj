<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController
{
    #[Route('/home')]
    public function hello(): Response
    {
        return new Response(
            '<html><body>Hello World!</body></html>'
        );
    }
}
