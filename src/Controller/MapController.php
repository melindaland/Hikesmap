<?php

namespace App\Controller;

use App\Repository\MarqueurRepository;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    // Route pour afficher la carte et les parcours
    #[Route('/carte', name: 'carte')]
    public function carte(ParcoursRepository $parcoursRepository): Response
    {
        $parcours = $parcoursRepository->findAll();
        return $this->render('map/index.html.twig', [
            'parcours' => $parcours, 
        ]);
    }

    // Route pour récupérer tous les marqueurs sous forme de liste JSON
    #[Route('/marqueurs', name: 'marqueurs', methods: ['GET'])]
    public function getMarqueurs(MarqueurRepository $marqueurRepository): JsonResponse
    {
        $marqueurs = $marqueurRepository->findAll();

        $data = array_map(fn($marqueur) => [
            'latitude' => $marqueur->getLatitude(),
            'longitude' => $marqueur->getLongitude(),
            'titre' => $marqueur->getTitre(),
            'description' => $marqueur->getDescription(),
            'image' => $marqueur->getImage(),
        ], $marqueurs);

        return new JsonResponse($data);
    }

    // Route pour récupérer les parcours sous forme de liste JSON
    #[Route('/parcours', name: 'parcours', methods: ['GET'])]
    public function getParcours(ParcoursRepository $parcoursRepository): JsonResponse
    {
        $parcoursList = $parcoursRepository->findAll();
        $data = array_map(fn($parcours) => [
            'id' => $parcours->getId(),
            'nom' => $parcours->getNom(),
            'marqueurs' => array_map(fn($marqueur) => [
                'latitude' => $marqueur->getLatitude(),
                'longitude' => $marqueur->getLongitude(),
            ], $parcours->getMarqueurs()->toArray())
        ], $parcoursList);

        return new JsonResponse($data);
    }
}
