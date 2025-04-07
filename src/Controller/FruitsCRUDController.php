<?php

namespace App\Controller;

use App\Entity\Fruits;
use App\Form\FruitsType;
use App\Repository\FruitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/fruits/c/r/u/d')]
final class FruitsCRUDController extends AbstractController{
    #[Route(name: 'app_fruits_c_r_u_d_index', methods: ['GET'])]
    public function index(FruitsRepository $fruitsRepository): Response
    {
        return $this->render('fruits_crud/index.html.twig', [
            'fruits' => $fruitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fruits_c_r_u_d_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fruit = new Fruits();
        $form = $this->createForm(FruitsType::class, $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fruit);
            $entityManager->flush();

            return $this->redirectToRoute('app_fruits_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fruits_crud/new.html.twig', [
            'fruit' => $fruit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fruits_c_r_u_d_show', methods: ['GET'])]
    public function show(Fruits $fruit): Response
    {
        return $this->render('fruits_crud/show.html.twig', [
            'fruit' => $fruit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fruits_c_r_u_d_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fruits $fruit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FruitsType::class, $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fruits_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fruits_crud/edit.html.twig', [
            'fruit' => $fruit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fruits_c_r_u_d_delete', methods: ['POST'])]
    public function delete(Request $request, Fruits $fruit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fruit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($fruit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fruits_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
