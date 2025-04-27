<?php

namespace App\Controller;

use App\Entity\User02;
use App\Form\User02Type;
use App\Repository\User02Repository;  // Use the correct repository
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user02')]
final class User02Controller extends AbstractController
{
    #[Route(name: 'app_user02_index', methods: ['GET'])]
    public function index(User02Repository $user02Repository): Response  // Use User02Repository
    {
        return $this->render('user02/index.html.twig', [
            'user02s' => $user02Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user02_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user02 = new User02();
        $form = $this->createForm(User02Type::class, $user02);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user02);
            $entityManager->flush();

            return $this->redirectToRoute('app_user02_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user02/new.html.twig', [
            'user02' => $user02,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user02_show', methods: ['GET'])]
    public function show(User02 $user02): Response
    {
        return $this->render('user02/show.html.twig', [
            'user02' => $user02,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user02_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User02 $user02, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User02Type::class, $user02);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user02_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user02/edit.html.twig', [
            'user02' => $user02,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user02_delete', methods: ['POST'])]
    public function delete(Request $request, User02 $user02, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user02->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user02);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user02_index', [], Response::HTTP_SEE_OTHER);
    }
}
