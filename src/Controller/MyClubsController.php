<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyClubsController extends AbstractController
{
    #[Route('/my-clubs', name: 'app_my_clubs')]
    public function myClubs(ClubRepository $clubRepository): Response
    {
        $user = $this->getUser(); // Get the currently logged-in user
    
        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirect if not logged in
        }
    
        // Fetch only the clubs that the user has joined
        $clubs = $user->getClubs(); // Assuming getClubs() returns the clubs joined by the user
    
        return $this->render('my_clubs/index.html.twig', [
            'clubs' => $clubs,
        ]);
    }
}
