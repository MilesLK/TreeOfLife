<?php

namespace App\Controller;

use App\Repository\FruitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CalendrierController extends AbstractController{
    #[Route('/calendrier', name: 'app_calendrier')]
    public function index(FruitsRepository $fruits): Response
    {
        $events = $fruits->findAll();

        $rdvs = [];

        foreach ($events as $events) {
            $rdvs[] = [
                'id' => $events->getId(),
                'date' => $events->getDate()->format('Y-m-d H:i:s'),
                'title' => $events->getName(),
                'extendedProps' => [
                    'evenement' => $events->getEvenement(),
                    'age' => $events->getAge(),
                ]
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('calendrier/index.html.twig', compact('data'));
        }
}
