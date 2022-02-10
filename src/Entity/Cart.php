<?php
namespace App\Entity;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="relation_cart")
     */ 
    private $product;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relation_cart")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="relation_cart")
     */
    private $restaurant;



    public function __construct()
    {
        $this->deliveries = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
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



    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }
}