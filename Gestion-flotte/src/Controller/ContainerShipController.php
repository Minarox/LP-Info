<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use App\Normalizer\ContainerShipNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function createContainership(Request $request): Response
    {
        $keys_check = ["name", "captain_name", "container_limit"];
        foreach ($keys_check as $key) {
            if ($request->request->get($key) == null) {
                return $this->json([
                    "error_code" => "400",
                    "error_description" => "'".$key."' key not specified in the body."
                ]);
            }
        }

        $doctrineManager = $this->getDoctrine()->getManager();

        $new_containership = new ContainerShip();
        $new_containership->setName($request->request->get("name"));
        $new_containership->setCaptainName($request->request->get("captain_name"));
        $new_containership->setContainerLimit($request->request->get("container_limit"));

        $doctrineManager->persist($new_containership);
        $doctrineManager->flush();

        $normalizer = new ContainerShipNormalizer();
        return $this->json([
            "success_code" => "201",
            "success_description" => "The containership has been registered.",
            "containership" => $normalizer->normalize($new_containership)
        ]);
    }
}
