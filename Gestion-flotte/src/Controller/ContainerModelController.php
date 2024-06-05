<?php

namespace App\Controller;

use App\Entity\ContainerModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerModelController extends AbstractController
{
    /**
     * @Route("/container-model", name="container-models", methods={"GET"})
     */
    public function getContainerModels(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerModel::class)->findAll());
    }

    /**
     * @Route("/container-model/{id}", name="container-model", methods={"GET"})
     */
    public function getContainerModel($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerModel::class)->find($id));
    }
}
