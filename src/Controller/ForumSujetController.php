<?php

namespace App\Controller;

use App\Entity\ForumSujet;
use App\Form\ForumSujetType;
use App\Repository\ForumSujetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/forum/sujet')]
final class ForumSujetController extends AbstractController
{
    #[Route(name: 'app_forum_sujet_index', methods: ['GET'])]
    public function index(ForumSujetRepository $forumSujetRepository): Response
    {
        return $this->render('forum_sujet/index.html.twig', [
            'forum_sujets' => $forumSujetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_forum_sujet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $forumSujet = new ForumSujet();
        $form = $this->createForm(ForumSujetType::class, $forumSujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($forumSujet);
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_sujet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum_sujet/new.html.twig', [
            'forum_sujet' => $forumSujet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_sujet_show', methods: ['GET'])]
    public function show(ForumSujet $forumSujet): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $messages = $forumSujet->getForumMessages(); 
        return $this->render('forum_sujet/show.html.twig', [
            'forum_sujet' => $forumSujet,
            'messages' => $messages, 
    ]);
}


    #[Route('/{id}/edit', name: 'app_forum_sujet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ForumSujet $forumSujet, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $form = $this->createForm(ForumSujetType::class, $forumSujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_sujet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum_sujet/edit.html.twig', [
            'forum_sujet' => $forumSujet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_sujet_delete', methods: ['POST'])]
    public function delete(Request $request, ForumSujet $forumSujet, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$forumSujet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($forumSujet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_sujet_index', [], Response::HTTP_SEE_OTHER);
    }
}
