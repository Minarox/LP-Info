<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use App\Normalizer\ContainerProductNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/container-product", name="container-products", methods={"GET"})
     */
    public function getContainerProducts(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerProduct::class)->findAll());
    }

    /**
     * @Route("/container-product/{id}", name="container-product", methods={"GET"})
     */
    public function getContainerProduct($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerProduct::class)->find($id));
    }

    /**
     * @Route("/container-product/new", name="add_product_in_container", methods={"POST"})
     */
    public function addProductInContainer(Request $request): Response
    {
        $keys_check = ["container_id", "product_id", "quantity"];
        foreach ($keys_check as $key) {
            if ($request->request->get($key) == null) {
                return $this->json([
                    "error_code" => "400",
                    "error_description" => "'".$key."' key not specified in the body."
                ]);
            }
        }

        $doctrineManager = $this->getDoctrine()->getManager();

        $container = $doctrineManager->getRepository(Container::class)->find($request->request->get("container_id"));
        if ($container == null) {
            return $this->json([
                "error_code" => "409",
                "error_description" => "The selected container does not exist."
            ]);
        }

        $container_model = $container->getContainerModel();
        $container_volume = $container_model->getLength()*$container_model->getWidth()*$container_model->getHeight();

        $container_product = $container->getContainerProducts();
        $products_volume = 0;
        foreach ($container_product as $container_p) {
            $products_container = $container_p->getProduct();
            $products_volume = $products_volume +
                ($products_container->getLength()*$products_container->getWidth()*$products_container->getHeight()) *
                $container_p->getQuantity();
        }

        $product = $doctrineManager->getRepository(Product::class)->find($request->request->get("product_id"));
        if ($product == null) {
            return $this->json([
                "error_code" => "409",
                "error_description" => "The selected product does not exist."
            ]);
        }

        $product_volume = ($product->getLength()*$product->getWidth()*$product->getHeight()) * $request->request->get("quantity");

        if ($products_volume + $product_volume > $container_volume) {
            return $this->json([
                "error_code" => "409",
                "error_description" =>
                    "The product or quantity of products you are trying to add to the container exceeds its total capacity."
            ]);
        }

        $new_container_product = new ContainerProduct();
        $new_container_product->setContainer($container);
        $new_container_product->setProduct($product);
        $new_container_product->setQuantity($request->request->get("quantity"));

        $doctrineManager->persist($new_container_product);
        $doctrineManager->flush();

        $normalizer = new ContainerProductNormalizer();
        return $this->json([
            "success_code" => "201",
            "success_description" => "The product has been registered in the container.",
            "container-product" => $normalizer->normalize($new_container_product)
        ]);
    }
}
