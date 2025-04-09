<?php

namespace App\Controller;

use App\Entity\Fruits;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods: ['PUT'])]
    public function majEvent(?Fruits $fruits, Request $request, EntityManagerInterface $em): Response
    {
        $donnees = json_decode($request->getContent());

        if (
            isset($donnees->name) && !empty($donnees->name) &&
            isset($donnees->date) && !empty($donnees->date) &&
            isset($donnees->age) && !empty($donnees->age) &&
            isset($donnees->evenement) && !empty($donnees->evenement) &&
            isset($donnees->occupation) && !empty($donnees->occupation)
        ) {
            $code = 200;

            if (!$fruits) {
                $fruits = new Fruits();
                $code = 201;
            }

            $fruits->setName($donnees->name);
            $fruits->setDate(new DateTime($donnees->date));
            $fruits->setAge($donnees->age);
            $fruits->setEvenement($donnees->evenement);
            $fruits->setOccupation($donnees->occupation);

            $em->persist($fruits);
            $em->flush();

            return new Response('Ok', $code);
        } else {
            return new Response('Données incomplètes', 400);
        }
    }
}
