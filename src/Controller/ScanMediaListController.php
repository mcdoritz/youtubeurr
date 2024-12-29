<?php

namespace App\Controller;

use App\Service\CommandManagerService;
use App\Service\MediaListManagerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ScanMediaListController extends AbstractController
{
    #[Route('/scan/{id}', name: 'scan.mediaList', requirements: ['id' => '.+'])]
    public function index(Request $request, MediaListManagerService $mediaListManagerService): Response
    {
        // Obtenir l'URL complète
        $fullUri = $request->getUri();
        // Extraire tout après "/scan/"
        $id = substr($fullUri, strpos($fullUri, '/scan/') + strlen('/scan/'));

        $results = $mediaListManagerService->scan($id);
        dd($results);
        if(is_array($results)) {
            foreach ($results as $result) {
                echo $result;
            }
        } else{
            echo $results;
        }
        return $this->render('scan_media_list/index.html.twig', [
            'controller_name' => 'ScanMediaListController',
        ]);
    }
}
