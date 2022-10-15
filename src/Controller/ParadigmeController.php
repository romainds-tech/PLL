<?php

namespace App\Controller;

use App\Entity\Paradigme;
use App\Form\ParadigmeType;
use App\Repository\ParadigmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paradigme')]
class ParadigmeController extends AbstractController
{
    #[Route('/', name: 'app_paradigme_index', methods: ['GET'])]
    public function index(ParadigmeRepository $paradigmeRepository): Response
    {
        return $this->render('paradigme/index.html.twig', [
            'paradigmes' => $paradigmeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paradigme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ParadigmeRepository $paradigmeRepository): Response
    {
        $paradigme = new Paradigme();
        $form = $this->createForm(ParadigmeType::class, $paradigme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paradigmeRepository->save($paradigme, true);

            return $this->redirectToRoute('app_paradigme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paradigme/new.html.twig', [
            'paradigme' => $paradigme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paradigme_show', methods: ['GET'])]
    public function show(Paradigme $paradigme): Response
    {
        return $this->render('paradigme/show.html.twig', [
            'paradigme' => $paradigme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paradigme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paradigme $paradigme, ParadigmeRepository $paradigmeRepository): Response
    {
        $form = $this->createForm(ParadigmeType::class, $paradigme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paradigmeRepository->save($paradigme, true);

            return $this->redirectToRoute('app_paradigme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paradigme/edit.html.twig', [
            'paradigme' => $paradigme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paradigme_delete', methods: ['POST'])]
    public function delete(Request $request, Paradigme $paradigme, ParadigmeRepository $paradigmeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paradigme->getId(), $request->request->get('_token'))) {
            $paradigmeRepository->remove($paradigme, true);
        }

        return $this->redirectToRoute('app_paradigme_index', [], Response::HTTP_SEE_OTHER);
    }
}
