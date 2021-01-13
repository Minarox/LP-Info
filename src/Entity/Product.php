<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="PRODUCT")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", length=11)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $length;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $width;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $height;

    /**
     * @ORM\OneToMany(targetEntity=ContainerProduct::class, mappedBy="product")
     */
    private $containerProducts;

    public function __construct()
    {
        $this->containerProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return Collection|ContainerProduct[]
     */
    public function getContainerProducts(): Collection
    {
        return $this->containerProducts;
    }

    public function addContainerProduct(ContainerProduct $containerProduct): self
    {
        if (!$this->containerProducts->contains($containerProduct)) {
            $this->containerProducts[] = $containerProduct;
            $containerProduct->setProduct($this);
        }

        return $this;
    }

    public function removeContainerProduct(ContainerProduct $containerProduct): self
    {
        if ($this->containerProducts->removeElement($containerProduct)) {
            // set the owning side to null (unless already changed)
            if ($containerProduct->getProduct() === $this) {
                $containerProduct->setProduct(null);
            }
        }

        return $this;
    }
}
