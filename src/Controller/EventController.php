<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use App\Repository\ClubRepository;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class EventController extends AbstractController
{
    #[Route('/event/add', name: 'eventAdd')]
    public function addEvent(
        Request $request,
        EntityManagerInterface $em,
        UserRepository $userRepository,
        ClubRepository $clubRepository,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}

        $event = new Event();
        $user = $userRepository->find(1);  //récupérer le user UNE FOIS QUON A LA CONNEXION
        $clubs = $user->getClubs();

        $form = $this->createForm(EventFormType::class, $event, [
            'clubs' => $clubs
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCreateAt(new \DateTime());
            $event->setLastModifiedAt(new \DateTime());
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('event/new.html.twig', [
            'eventForm' => $form->createView(),
        ]);

    }

    #[Route('/event/modify/{id}', name: 'eventModify')]
    public function modifyEvent(
        Request $request,
        EventRepository $eventRepository,
        EntityManagerInterface $em,
        $id,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}

        $event = $eventRepository->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        $form = $this->createForm(EventFormType::class,$event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setLastModifiedAt(new \DateTime());
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('accueil'); // Change this to your desired route
        }

        return $this->render('event/modifyEvent.html.twig', [
            'clubForm' => $form->createView(),
        ]);
    }
/*
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
