<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use OpenAI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class GptController extends AbstractController
{
    #[Route('/gpt/{id}', name: 'app_gpt')]
    public function index(
        EntityManagerInterface $em,
        ClubRepository $clubRepository,
        $id,


    ): Response
    {

        try {
            $club = $clubRepository->find($id);
            $msg = file_get_contents(__DIR__ . '/prompt.txt');
            $prompt = null;

            if ($club) {

                $values = [
                    '{clubTitre}' => $club->getName()
                ];
                $prompt = strtr($msg, $values);

                ////////////// A PARTIR DICI ON UTILISE LE MOTEUR DE GPT $$$$$$$$$$$$$$$$$$$$/////////////////////////////////////

                // Clés d'API de ChatGPT

                $apiKey = $this->getParameter('api_key');
                // Configurer le client
                $client = OpenAI::client($apiKey);

                //Crée une image à partir d'un prompt
                $response = $client->images()->create([
                    'model' => 'dall-e-2',
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'response_format' => 'url',
                ]);
                
                $response->created;

                $url = null;

                foreach ($response->data as $data) {
                    $url = $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
                    $data->b64_json; // null
                }

                //////////////////////////////////////////////////////////////////////////

                
                $saveDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads/clubs';
                $fileName = $club->getId() . '_club_image.jpg';

                $this->saveImageFromUrl($url,$saveDirectory,$fileName);

                $club->setclubImg($fileName);
                $em->persist($club);
                $em->flush();

            } else {
                throw new \Exception('club null');
            }

            } catch (\Exception $e) { 

                $this->addFlash('error', 'Le club n existe pas?');
                return $this->redirectToRoute('app_my_clubs');

            }

        return $this->redirectToRoute('accueil');
    }

    

    public function saveImageFromUrl(string $imageUrl, string $saveDirectory, string $fileName): ?string
    {
    
        // Ensure the directory exists or create it
        if (!file_exists($saveDirectory) && !mkdir($saveDirectory, 0777, true) && !is_dir($saveDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $saveDirectory));
        }

        try {
            // Get the image content from the URL
            $imageContent = file_get_contents($imageUrl);
            if ($imageContent === false) {
                throw new \Exception("Could not fetch the image from the URL.");
            }

            // Save the image to the desired location
            $filePath = $saveDirectory . '/' . $fileName;
            file_put_contents($filePath, $imageContent);

            return $filePath; // Return the saved file path for further use
        } catch (\Exception $e) {
            // Handle any error, log it, or throw an exception
            throw new FileException("Failed to save the image: " . $e->getMessage());
        }
    }


}
