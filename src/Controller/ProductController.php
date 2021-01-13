<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function createProduct(): Response
    {
        // TODO: Création d'un produit
    }

    /**
     * @Route("/product-container/new", name="add_product_in_container", methods={"POST"})
     */
    public function addProductInContainer(): Response
    {
        // TODO: Ajout d'un produit dans un conteneur
    }
}
