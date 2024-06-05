<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerShip;
use App\Normalizer\ContainerNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function createContainer(Request $request): Response
    {
        $keys_check = ["color", "container_model_id", "containership_id"];
        foreach ($keys_check as $key) {
            if ($request->request->get($key) == null) {
                return $this->json([
                    "error_code" => "400",
                    "error_description" => "'".$key."' key not specified in the body."
                ]);
            }
        }

        $doctrineManager = $this->getDoctrine()->getManager();

        $container_model = $doctrineManager->getRepository(ContainerModel::class)
            ->find($request->request->get("container_model_id"));
        if ($container_model == null) {
            return $this->json([
                "error_code" => "409",
                "error_description" => "The selected container model does not exist."
            ]);
        }

        $containership = $doctrineManager->getRepository(ContainerShip::class)
            ->find($request->request->get("containership_id"));
        if ($containership == null) {
            return $this->json([
                "error_code" => "409",
                "error_description" => "The selected containership does not exist."
            ]);
        }

        $containership_limit = $doctrineManager->getRepository(ContainerShip::class)
            ->createQueryBuilder('containership')
            ->select('containership.container_limit')
            ->where('containership.id = '.$request->request->get("containership_id"))
            ->getQuery()
            ->getSingleScalarResult();

        $containers_on_ship = $doctrineManager->getRepository(Container::class)
            ->createQueryBuilder('container')
            ->select('count(container.id)')
            ->where('container.containership = '.$request->request->get("containership_id"))
            ->getQuery()
            ->getSingleScalarResult();

        if ($containers_on_ship + 1 > $containership_limit) {
            return $this->json([
                "error_code" => "409",
                "error_description" => "The number of containers exceeds the limit of the containership."
            ]);
        }

        $new_container = new Container();
        $new_container->setColor($request->request->get("color"));
        $new_container->setContainerModel($container_model);
        $new_container->setContainership($containership);

        $doctrineManager->persist($new_container);
        $doctrineManager->flush();

        $normalizer = new ContainerNormalizer();
        return $this->json([
           "success_code" => "201",
           "success_description" => "The container has been registered.",
           "container" => $normalizer->normalize($new_container)
        ]);
    }
}
