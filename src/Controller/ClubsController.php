<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ClubsController extends AbstractController
{
    #[Route('/club/add', name: 'clubAdd')]
    public function addClub(
        Request $request,
        EntityManagerInterface $em,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}

        $club = new Club();
        $form = $this->createForm(ClubFormType::class,$club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $club->setCreatedAt(new \DateTimeImmutable());
            $club->setLastModifiedAt(new \DateTimeImmutable());
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('accueil'); // Change this to your desired route
        }

        return $this->render('clubs/addClub.html.twig', [
            'clubForm' => $form->createView(),
        ]);
    }
}
