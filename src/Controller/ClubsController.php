<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubFormType;
use App\Repository\ClubRepository;
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

    #[Route('/club/modify/{id}', name: 'clubModify')]
    public function modifyClub(
        Request $request,
        ClubRepository $clubRepository,
        EntityManagerInterface $em,
        $id,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}

        $club = $clubRepository->find($id);

        if (!$club) {
            throw $this->createNotFoundException('Club not found');
        }

        $form = $this->createForm(ClubFormType::class,$club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $club->setLastModifiedAt(new \DateTimeImmutable());
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('accueil'); // Change this to your desired route
        }

        return $this->render('clubs/modifyClub.html.twig', [
            'clubForm' => $form->createView(),
        ]);
    }

    #[Route('/club/delete/{id}', name: 'clubDelete')]
    public function deleteClub(
        Request $request,
        ClubRepository $clubRepository,
        EntityManagerInterface $em,
        $id,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}

        $club = $clubRepository->find($id);

        if (!$club) {
            throw $this->createNotFoundException('Club not found');
        }
        // on supprime les events lies au club avant
        $clubEvents = $club->getEvents();
        foreach ($clubEvents as $event) {
            $em->remove($event);
        }
        $em->flush();

        $em->remove($club);
        $em->flush();

        return $this->redirectToRoute('accueil');

    }

    #[Route('/club/join/{id}', name: 'clubJoin')]
    public function joinClub(
        Request $request,
        ClubRepository $clubRepository,
        EntityManagerInterface $em,
        $id,
        Security $security
    ): Response {
        // Retrieve the currently logged-in user
        $user = $this->getUser();

        if ($user) {
            // Find the club by its ID
            $club = $clubRepository->find($id);

            if (!$club) {
                // Club not found, throw a 404 exception
                throw $this->createNotFoundException('Club not found');
            }
            
            // Add the user to the club
            $club->addUser($user);

            // Persist changes to the database
            $em->persist($club);
            $em->flush();

            // Optional: Add a flash message to notify the user
            $this->addFlash('success', 'You have joined the club!');
        } else {
            // Optionally handle the case where the user is not logged in
            $this->addFlash('error', 'You need to be logged in to join a club.');
        }

        // Redirect to the accueil (home) route
        return $this->redirectToRoute('accueil');
    }

    #[Route('/club/unjoin/{id}', name: 'clubUnjoin')]
    public function unjoinClub(
        Request $request,
        ClubRepository $clubRepository,
        EntityManagerInterface $em,
        $id,
        Security $security
    ): Response {
        // Retrieve the currently logged-in user
        $user = $this->getUser();

        if ($user) {
            // Find the club by its ID
            $club = $clubRepository->find($id);

            if (!$club) {
                // Club not found, throw a 404 exception
                throw $this->createNotFoundException('Club not found');
            }
            
            // Add the user to the club
            $club->removeUser($user);

            // Persist changes to the database
            $em->persist($club);
            $em->flush();

            // Optional: Add a flash message to notify the user
            $this->addFlash('success', 'You have Unjoined the club!');
        } else {
            // Optionally handle the case where the user is not logged in
            $this->addFlash('error', 'You need to be logged in to Unjoin a club.');
        }

        // Redirect to the accueil (home) route
        return $this->redirectToRoute('accueil');
    }

}