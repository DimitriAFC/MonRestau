<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="products")
     */
    private $relation_restaurant;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $relation_category;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="product")
     */
    private $relation_cart;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="product")
     */
    private $relation_orderitem;

    public function __construct()
    {
        $this->relation_cart = new ArrayCollection();
        $this->relation_orderitem = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRelationRestaurant(): ?Restaurant
    {
        return $this->relation_restaurant;
    }

    public function setRelationRestaurant(?Restaurant $relation_restaurant): self
    {
        $this->relation_restaurant = $relation_restaurant;

        return $this;
    }

    public function getRelationCategory(): ?Category
    {
        return $this->relation_category;
    }

    public function setRelationCategory(?Category $relation_category): self
    {
        $this->relation_category = $relation_category;

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getRelationCart(): Collection
    {
        return $this->relation_cart;
    }

    public function addRelationCart(Cart $relationCart): self
    {
        if (!$this->relation_cart->contains($relationCart)) {
            $this->relation_cart[] = $relationCart;
            $relationCart->setProduct($this);
        }

        return $this;
    }

    public function removeRelationCart(Cart $relationCart): self
    {
        if ($this->relation_cart->removeElement($relationCart)) {
            // set the owning side to null (unless already changed)
            if ($relationCart->getProduct() === $this) {
                $relationCart->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getRelationOrderitem(): Collection
    {
        return $this->relation_orderitem;
    }

    public function addRelationOrderitem(OrderItem $relationOrderitem): self
    {
        if (!$this->relation_orderitem->contains($relationOrderitem)) {
            $this->relation_orderitem[] = $relationOrderitem;
            $relationOrderitem->setProduct($this);
        }

        return $this;
    }

    public function removeRelationOrderitem(OrderItem $relationOrderitem): self
    {
        if ($this->relation_orderitem->removeElement($relationOrderitem)) {
            // set the owning side to null (unless already changed)
            if ($relationOrderitem->getProduct() === $this) {
                $relationOrderitem->setProduct(null);
            }
        }

        return $this;
    }
}
