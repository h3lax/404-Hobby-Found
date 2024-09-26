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
        Security $security
    ): Response {
    // Instantiate a new Club entity
    $club = new Club();

    // Create and handle the form submission
    $form = $this->createForm(ClubFormType::class, $club);
    $form->handleRequest($request);

    // Check if the form is submitted and valid
    if ($form->isSubmitted() && $form->isValid()) {
        // Retrieve the uploaded file from the form (assuming 'clubImg' is the file field name)
        $file = $form->get('clubImg')->getData(); // Retrieve the file

        // Handle the file upload if a file was submitted
        if ($file) {
            // Generate a unique file name for the uploaded image
            $filename = md5(uniqid()).'.'.$file->guessExtension();

            try {
                // Move the file to the directory where club images are stored
                $file->move(
                    $this->getParameter('club_uploads_directory'),
                    $filename
                );
                // Set the image filename in the Club entity
                $club->setClubImg($filename);
            } catch (FileException $e) {
                // Handle file upload error (e.g., add flash message or log the error)
                $this->addFlash('error', 'File upload failed: ' . $e->getMessage());
                return $this->redirectToRoute('clubAdd'); // Redirect or handle as necessary
            }
        }

        // Set additional properties for the club
        $club->setCreatedAt(new \DateTimeImmutable());
        $club->setLastModifiedAt(new \DateTimeImmutable());

        // Persist the new club entity to the database
        $em->persist($club);
        $em->flush();

        // Redirect to the homepage (or your desired route)
        return $this->redirectToRoute('accueil');
    }

    // Render the form if it is not submitted or not valid
    return $this->render('clubs/addClub.html.twig', [
        'clubForm' => $form->createView(),
    ]);
}

#[Route('/club/modify/{id}', name: 'clubModify')]
public function modifyClub(
    Request $request,
    ClubRepository $clubRepository,
    EntityManagerInterface $em,
    Security $security,
    $id
): Response {

    // Check if the user has permission to modify the club
    $club = $clubRepository->find($id);

    if (!$club) {
        $this->addFlash('error', 'Club not found.');
        return $this->redirectToRoute('accueil');
    }

    $form = $this->createForm(ClubFormType::class, $club);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Handle image upload if a file was uploaded
        $file = $form->get('clubImg')->getData();
        if ($file) {
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('club_uploads_directory'), $filename);
                $club->setClubImg($filename);
            } catch (FileException $e) {
                $this->addFlash('error', 'File upload failed.');
                return $this->redirectToRoute('clubModify', ['id' => $club->getId()]);
            }
        }

        // Update the last modification date and save changes
        $club->setLastModifiedAt(new \DateTimeImmutable());
        $em->persist($club);
        $em->flush();

        $this->addFlash('success', 'Club modified successfully.');

        return $this->redirectToRoute('app_my_clubs'); // Or 'clubDetails', 'clubList', etc.
    }

    return $this->render('clubs/modifyClub.html.twig', [
        'clubForm' => $form->createView(),
    ]);
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

        return $this->redirectToRoute('app_my_clubs');

    }
}