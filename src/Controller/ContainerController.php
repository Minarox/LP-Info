<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="containers", methods={"GET"})
     */
    public function getContainers(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", name="container", methods={"GET"})
     */
    public function getContainer($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/container/new", name="new_container", methods={"POST"})
     */
    public function createContainer(): Response
    {
        // TODO: Création d'un container
    }
}
