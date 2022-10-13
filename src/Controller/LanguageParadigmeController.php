<?php

namespace App\Controller;

use App\Entity\LanguageParadigme;
use App\Form\LanguageParadigmeType;
use App\Repository\LanguageParadigmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/language/paradigme')]
class LanguageParadigmeController extends AbstractController
{
    #[Route('/', name: 'app_language_paradigme_index', methods: ['GET'])]
    public function index(LanguageParadigmeRepository $languageParadigmeRepository): Response
    {
        return $this->render('language_paradigme/index.html.twig', [
            'language_paradigmes' => $languageParadigmeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_language_paradigme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LanguageParadigmeRepository $languageParadigmeRepository): Response
    {
        $languageParadigme = new LanguageParadigme();
        $form = $this->createForm(LanguageParadigmeType::class, $languageParadigme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageParadigmeRepository->save($languageParadigme, true);

            return $this->redirectToRoute('app_language_paradigme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_paradigme/new.html.twig', [
            'language_paradigme' => $languageParadigme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_paradigme_show', methods: ['GET'])]
    public function show(LanguageParadigme $languageParadigme): Response
    {
        return $this->render('language_paradigme/show.html.twig', [
            'language_paradigme' => $languageParadigme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_language_paradigme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LanguageParadigme $languageParadigme, LanguageParadigmeRepository $languageParadigmeRepository): Response
    {
        $form = $this->createForm(LanguageParadigmeType::class, $languageParadigme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageParadigmeRepository->save($languageParadigme, true);

            return $this->redirectToRoute('app_language_paradigme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_paradigme/edit.html.twig', [
            'language_paradigme' => $languageParadigme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_paradigme_delete', methods: ['POST'])]
    public function delete(Request $request, LanguageParadigme $languageParadigme, LanguageParadigmeRepository $languageParadigmeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageParadigme->getId(), $request->request->get('_token'))) {
            $languageParadigmeRepository->remove($languageParadigme, true);
        }

        return $this->redirectToRoute('app_language_paradigme_index', [], Response::HTTP_SEE_OTHER);
    }
}
