<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
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

        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        if ($user instanceof User) {
            $clubs = $user->getClubs();

            $form = $this->createForm(EventFormType::class, $event, [
            'clubs' => $clubs,
            'is_editing' => false, // Setting is_editing to false for creation
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
        return $this->redirectToRoute('accueil');

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
        $user = $this->getUser();
        if ($user instanceof User) {

            $event = $eventRepository->find($id);
            $clubs = $user->getClubs();

            $form = $this->createForm(EventFormType::class, $event, [
            'clubs' => $clubs,
            'is_editing' => true, // Setting is_editing to false for creation
             ]);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $event->setLastModifiedAt(new \DateTime());
                $em->persist($event);
                $em->flush();
                return $this->redirectToRoute('accueil');
            }
            return $this->render('event/new.html.twig', [
                'eventForm' => $form->createView(),
            ]);
            
        }
        return $this->redirectToRoute('accueil');

    }

    #[Route('/event/delete/{id}', name: 'eventDelete')]
    public function deleteEvent(
        Request $request,
        EventRepository $eventRepository,
        EntityManagerInterface $em,
        $id,
        Security $security): Response
    {

        //if (!$security->isGranted('ROLE_ADMIN')) {
        //    return $this->redirectToRoute('dashboard');
        //}
        $user = $this->getUser();
        if ($user instanceof User) {

            $event = $eventRepository->find($id);
            if (!$event) {
                throw $this->createNotFoundException('Club not found');
            }
            // Penser à supprimer tous les events liés au club avant !!
            // Penser à ajouter un flash
            $em->remove($event);
            $em->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->redirectToRoute('accueil');

    }


}
