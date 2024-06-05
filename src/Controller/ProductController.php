<?php

namespace App\Controller;

use App\Entity\Product;
use App\Normalizer\ProductNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="products", methods={"GET"})
     */
    public function getProducts(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}", name="product", methods={"GET"})
     */
    public function getProduct(int $id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product/new", name="new_product", methods={"POST"})
     */
    public function createProduct(Request $request): Response
    {
        $keys_check = ["name", "length", "width", "height"];
        foreach ($keys_check as $key) {
            if ($request->request->get($key) == null) {
                return $this->json([
                    "error_code" => "400",
                    "error_description" => "'".$key."' key not specified in the body."
                ]);
            }
        }

        $doctrineManager = $this->getDoctrine()->getManager();

        $new_product = new Product();
        $new_product->setName($request->request->get("name"));
        $new_product->setLength($request->request->get("length"));
        $new_product->setWidth($request->request->get("width"));
        $new_product->setHeight($request->request->get("height"));

        $doctrineManager->persist($new_product);
        $doctrineManager->flush();

        $normalizer = new ProductNormalizer();
        return $this->json([
            "success_code" => "201",
            "success_description" => "The product has been registered.",
            "product" => $normalizer->normalize($new_product)
        ]);
    }
}
