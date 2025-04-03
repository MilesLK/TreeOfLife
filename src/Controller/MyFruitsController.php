<?php

namespace App\Controller;

use App\Repository\FruitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MyFruitsController extends AbstractController{
    #[Route('/my/fruits', name: 'app_my_fruits')]
    public function index(FruitsRepository $fruitsRepository): Response
    {
        $elements = $fruitsRepository->findAll();

        return $this->render('my_fruits/index.html.twig', [
            'elements' => $elements,
        ]);
    }
}
