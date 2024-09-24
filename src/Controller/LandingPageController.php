<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(
        ClubRepository $clubRepository,

    ): Response
    {

        $clubs = $clubRepository->findAll();

        
        return $this->render('accueil/index.html.twig',[
            'clubs'=>$clubs,
        ]);
    }


}
