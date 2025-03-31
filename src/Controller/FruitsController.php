<?php

namespace App\Controller;

use App\Entity\Fruits;
use App\Form\FruitsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FruitsController extends AbstractController
{
    #[Route('/fruits/add', name: 'add_fruit')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fruit = new Fruits();
        $form = $this->createForm(FruitsType::class, $fruit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fruit);
            $entityManager->flush();

            $this->addFlash('success', 'Fruit ajouté avec succès !');
            return $this->redirectToRoute('add_fruit');
        }

        return $this->render('my_fruits/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
