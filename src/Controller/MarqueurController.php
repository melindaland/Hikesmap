<?php

namespace App\Controller;

use App\Entity\Marqueur;
use App\Form\MarqueurType;
use App\Repository\MarqueurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/marqueur')]
final class MarqueurController extends AbstractController
{
    #[Route(name: 'app_marqueur_index', methods: ['GET'])]
    public function index(MarqueurRepository $marqueurRepository): Response
    {
        return $this->render('marqueur/index.html.twig', [
            'marqueurs' => $marqueurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_marqueur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $marqueur = new Marqueur();
        $form = $this->createForm(MarqueurType::class, $marqueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($marqueur);
            $entityManager->flush();

            return $this->redirectToRoute('app_marqueur_index');
        }

        return $this->render('marqueur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_marqueur_show', methods: ['GET'])]
    public function show(Marqueur $marqueur): Response
    {
        return $this->render('marqueur/show.html.twig', [
            'marqueur' => $marqueur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_marqueur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Marqueur $marqueur, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $form = $this->createForm(MarqueurType::class, $marqueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_marqueur_index');
        }

        return $this->render('marqueur/edit.html.twig', [
            'form' => $form->createView(),
            'marqueur' => $marqueur,
        ]);
    }

    #[Route('/{id}', name: 'app_marqueur_delete', methods: ['POST'])]
    public function delete(Request $request, Marqueur $marqueur, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete' . $marqueur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($marqueur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_marqueur_index');
    }
}