<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FeedbackController extends AbstractController
{
    #[Route('/feedback', name: 'app_feedback_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $feedback = $entityManager
            ->getRepository(Feedback::class)
            ->findAll();

        return $this->render('feedback/index.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    #[Route('/feedback/new', name: 'app_feedback_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_feedback_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feedback/new.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }

    #[Route('/feedback/{idFeedback}', name: 'app_feedback_show', methods: ['GET'])]
    public function show(Feedback $feedback): Response
    {
        return $this->render('feedback/show.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    #[Route('/feedback/{idFeedback}/edit', name: 'app_feedback_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_feedback_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feedback/edit.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }

    #[Route('/feedback/{idFeedback}', name: 'app_feedback_delete', methods: ['POST'])]
    public function delete(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feedback->getIdFeedback(), $request->request->get('_token'))) {
            $entityManager->remove($feedback);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_feedback_index', [], Response::HTTP_SEE_OTHER);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    #[Route('/feedbackFront', name: 'app_feedback_indexFront', methods: ['GET'])]
    public function indexFront(EntityManagerInterface $entityManager): Response
    {
        $feedback = $entityManager
            ->getRepository(Feedback::class)
            ->findAll();

        return $this->render('feedback/indexFront.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    
    #[Route('/feedbackFront/new', name: 'app_feedback_newFront', methods: ['GET', 'POST'])]
    public function newFront(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_feedback_indexFront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feedback/newFront.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }

    #[Route('/feedbackFront/{idFeedback}', name: 'app_feedback_showFront', methods: ['GET'])]
    public function showFront(Feedback $feedback): Response
    {
        return $this->render('feedback/showFront.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    #[Route('/feedbackFront/{idFeedback}/edit', name: 'app_feedback_editFront', methods: ['GET', 'POST'])]
    public function editFront(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_feedback_indexFront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feedback/editFront.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }
    #[Route('/feedbackFront/{idFeedback}', name: 'app_feedback_deleteFront', methods: ['POST'])]
    public function deleteFront(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feedback->getIdFeedback(), $request->request->get('_token'))) {
            $entityManager->remove($feedback);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_feedback_indexFront', [], Response::HTTP_SEE_OTHER);
    }
}
