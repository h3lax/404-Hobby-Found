<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class EventController extends AbstractController
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

        $event = new Event();

        /*
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
        // Penser à supprimer tous les events liés au club avant !!
        // Penser à ajouter un flash
        $em->remove($club);
        $em->flush();

        return $this->redirectToRoute('accueil');

    }
    */
}
