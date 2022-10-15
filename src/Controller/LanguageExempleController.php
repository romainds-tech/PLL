<?php

namespace App\Controller;

use App\Entity\LanguageExemple;
use App\Form\LanguageExempleType;
use App\Repository\LanguageExempleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/languageexemple')]
class LanguageExempleController extends AbstractController
{
    #[Route('/', name: 'app_language_exemple_index', methods: ['GET'])]
    public function index(LanguageExempleRepository $languageExempleRepository): Response
    {
        return $this->render('language_exemple/index.html.twig', [
            'language_exemples' => $languageExempleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_language_exemple_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LanguageExempleRepository $languageExempleRepository): Response
    {
        $languageExemple = new LanguageExemple();
        $form = $this->createForm(LanguageExempleType::class, $languageExemple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExempleRepository->save($languageExemple, true);

            return $this->redirectToRoute('app_language_exemple_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_exemple/new.html.twig', [
            'language_exemple' => $languageExemple,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_exemple_show', methods: ['GET'])]
    public function show(LanguageExemple $languageExemple): Response
    {
        return $this->render('language_exemple/show.html.twig', [
            'language_exemple' => $languageExemple,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_language_exemple_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LanguageExemple $languageExemple, LanguageExempleRepository $languageExempleRepository): Response
    {
        $form = $this->createForm(LanguageExempleType::class, $languageExemple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExempleRepository->save($languageExemple, true);

            return $this->redirectToRoute('app_language_exemple_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_exemple/edit.html.twig', [
            'language_exemple' => $languageExemple,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_exemple_delete', methods: ['POST'])]
    public function delete(Request $request, LanguageExemple $languageExemple, LanguageExempleRepository $languageExempleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageExemple->getId(), $request->request->get('_token'))) {
            $languageExempleRepository->remove($languageExemple, true);
        }

        return $this->redirectToRoute('app_language_exemple_index', [], Response::HTTP_SEE_OTHER);
    }
}
