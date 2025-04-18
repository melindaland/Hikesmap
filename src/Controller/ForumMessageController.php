<?php

namespace App\Controller;

use App\Entity\ForumMessage;
use App\Form\ForumMessageType;
use App\Repository\ForumMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/forum/message')]
final class ForumMessageController extends AbstractController
{
    #[Route(name: 'app_forum_message_index', methods: ['GET'])]
    public function index(ForumMessageRepository $forumMessageRepository): Response
    {
        return $this->render('forum_message/index.html.twig', [
            'forum_messages' => $forumMessageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_forum_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $forumMessage = new ForumMessage();
        $form = $this->createForm(ForumMessageType::class, $forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($forumMessage);
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum_message/new.html.twig', [
            'forum_message' => $forumMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_message_show', methods: ['GET'])]
    public function show(ForumMessage $forumMessage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('forum_message/show.html.twig', [
            'forum_message' => $forumMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_forum_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ForumMessage $forumMessage, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $form = $this->createForm(ForumMessageType::class, $forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum_message/edit.html.twig', [
            'forum_message' => $forumMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_message_delete', methods: ['POST'])]
    public function delete(Request $request, ForumMessage $forumMessage, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$forumMessage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($forumMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
