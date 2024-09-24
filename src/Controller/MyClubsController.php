<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyClubsController extends AbstractController
{
    #[Route('/club', name: 'app_my_clubs')]
    public function index(): Response
    {
        return $this->render('my_clubs/index.html.twig', [
            'controller_name' => 'MyClubsController',
        ]);
    }
}
