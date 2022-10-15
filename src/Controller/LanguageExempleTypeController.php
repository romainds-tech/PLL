<?php

namespace App\Controller;

use App\Entity\LanguageExempleType;
use App\Form\LanguageExempleTypeType;
use App\Repository\LanguageExempleTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/languageexempletype')]
class LanguageExempleTypeController extends AbstractController
{
    #[Route('/', name: 'app_language_exemple_type_index', methods: ['GET'])]
    public function index(LanguageExempleTypeRepository $languageExempleTypeRepository): Response
    {
        return $this->render('language_exemple_type/index.html.twig', [
            'language_exemple_types' => $languageExempleTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_language_exemple_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LanguageExempleTypeRepository $languageExempleTypeRepository): Response
    {
        $languageExempleType = new LanguageExempleType();
        $form = $this->createForm(LanguageExempleTypeType::class, $languageExempleType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExempleTypeRepository->save($languageExempleType, true);

            return $this->redirectToRoute('app_language_exemple_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_exemple_type/new.html.twig', [
            'language_exemple_type' => $languageExempleType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_exemple_type_show', methods: ['GET'])]
    public function show(LanguageExempleType $languageExempleType): Response
    {
        return $this->render('language_exemple_type/show.html.twig', [
            'language_exemple_type' => $languageExempleType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_language_exemple_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LanguageExempleType $languageExempleType, LanguageExempleTypeRepository $languageExempleTypeRepository): Response
    {
        $form = $this->createForm(LanguageExempleTypeType::class, $languageExempleType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExempleTypeRepository->save($languageExempleType, true);

            return $this->redirectToRoute('app_language_exemple_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_exemple_type/edit.html.twig', [
            'language_exemple_type' => $languageExempleType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_exemple_type_delete', methods: ['POST'])]
    public function delete(Request $request, LanguageExempleType $languageExempleType, LanguageExempleTypeRepository $languageExempleTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageExempleType->getId(), $request->request->get('_token'))) {
            $languageExempleTypeRepository->remove($languageExempleType, true);
        }

        return $this->redirectToRoute('app_language_exemple_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
