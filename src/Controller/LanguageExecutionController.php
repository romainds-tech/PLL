<?php

namespace App\Controller;

use App\Entity\LanguageExecution;
use App\Form\LanguageExecutionType;
use App\Repository\LanguageExecutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/language/execution')]
class LanguageExecutionController extends AbstractController
{
    #[Route('/', name: 'app_language_execution_index', methods: ['GET'])]
    public function index(LanguageExecutionRepository $languageExecutionRepository): Response
    {
        return $this->render('language_execution/index.html.twig', [
            'language_executions' => $languageExecutionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_language_execution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LanguageExecutionRepository $languageExecutionRepository): Response
    {
        $languageExecution = new LanguageExecution();
        $form = $this->createForm(LanguageExecutionType::class, $languageExecution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExecutionRepository->save($languageExecution, true);

            return $this->redirectToRoute('app_language_execution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_execution/new.html.twig', [
            'language_execution' => $languageExecution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_execution_show', methods: ['GET'])]
    public function show(LanguageExecution $languageExecution): Response
    {
        return $this->render('language_execution/show.html.twig', [
            'language_execution' => $languageExecution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_language_execution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LanguageExecution $languageExecution, LanguageExecutionRepository $languageExecutionRepository): Response
    {
        $form = $this->createForm(LanguageExecutionType::class, $languageExecution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageExecutionRepository->save($languageExecution, true);

            return $this->redirectToRoute('app_language_execution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('language_execution/edit.html.twig', [
            'language_execution' => $languageExecution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_language_execution_delete', methods: ['POST'])]
    public function delete(Request $request, LanguageExecution $languageExecution, LanguageExecutionRepository $languageExecutionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageExecution->getId(), $request->request->get('_token'))) {
            $languageExecutionRepository->remove($languageExecution, true);
        }

        return $this->redirectToRoute('app_language_execution_index', [], Response::HTTP_SEE_OTHER);
    }
}
