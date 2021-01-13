<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="containerships", methods={"GET"})
     */
    public function getContainerships(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerShip::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="containership", methods={"GET"})
     */
    public function getContainership(int $id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerShip::class)->find($id));
    }

    /**
     * @Route("/containership/new", name="new_containership", methods={"POST"})
     */
    public function createContainership(): Response
    {
        // TODO: Création d'un porte-conteneurs
    }
}
