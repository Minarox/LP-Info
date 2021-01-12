<?php

namespace App\Entity;

use App\Repository\ContainerProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerProductRepository::class)
 * @ORM\Table(name="CONTAINER_PRODUCT")
 */
class ContainerProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", length=11)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Container::class, inversedBy="containerProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $container;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="containerProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContainerId(): ?Container
    {
        return $this->container;
    }

    public function setContainerId(?Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product;
    }

    public function setProductId(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
