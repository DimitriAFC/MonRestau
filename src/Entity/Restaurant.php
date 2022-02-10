<?php
namespace App\Entity;
use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adress;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;
    /**
     * @ORM\ManyToMany(targetEntity=ZipCode::class, inversedBy="restaurants")
     */
    private $relation_zipcode;
    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="restaurants")
     */
    private $relation_secteur;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="restaurants")
     */
    private $relation_user;
    /**
     * @ORM\ManyToOne(targetEntity=RestaurantType::class, inversedBy="restaurants")
     */
    private $relation_type;
    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="relation_restaurant")
     */
    private $products;
    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="relation_restaurant")
     */
    private $deliveries;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="restaurant")
     */
    private $relation_order;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="restaurant")
     */
    private $relation_cart;

    public function __construct()
    {
        $this->relation_zipcode = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
        $this->relation_order = new ArrayCollection();
        $this->relation_cart = new ArrayCollection();
    }
    public function __toString()
    {

        return $this->name;
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
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
    public function getAdress(): ?string
    {
        return $this->adress;
    }
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
    /**
     * @return Collection|ZipCode[]
     */
    public function getRelationZipcode(): Collection
    {
        return $this->relation_zipcode;
    }
    public function addRelationZipcode(ZipCode $relationZipcode): self
    {
        if (!$this->relation_zipcode->contains($relationZipcode)) {
            $this->relation_zipcode[] = $relationZipcode;
        }
        return $this;
    }
    public function removeRelationZipcode(ZipCode $relationZipcode): self
    {
        $this->relation_zipcode->removeElement($relationZipcode);
        return $this;
    }
    public function getRelationSecteur(): ?Secteur
    {
        return $this->relation_secteur;
    }
    public function setRelationSecteur(?Secteur $relation_secteur): self
    {
        $this->relation_secteur = $relation_secteur;
        return $this;
    }
    public function getRelationUser(): ?User
    {
        return $this->relation_user;
    }
    public function setRelationUser(?User $relation_user): self
    {
        $this->relation_user = $relation_user;
        return $this;
    }
    public function getRelationType(): ?RestaurantType
    {
        return $this->relation_type;
    }
    public function setRelationType(?RestaurantType $relation_type): self
    {
        $this->relation_type = $relation_type;
        return $this;
    }
    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setRelationRestaurant($this);
        }
        return $this;
    }
    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getRelationRestaurant() === $this) {
                $product->setRelationRestaurant(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Delivery[]
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }
    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries[] = $delivery;
            $delivery->setRelationRestaurant($this);
        }
        return $this;
    }
    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getRelationRestaurant() === $this) {
                $delivery->setRelationRestaurant(null);
            }
        }
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

    /**
     * @return Collection|Order[]
     */
    public function getRelationOrder(): Collection
    {
        return $this->relation_order;
    }

    public function addRelationOrder(Order $relationOrder): self
    {
        if (!$this->relation_order->contains($relationOrder)) {
            $this->relation_order[] = $relationOrder;
            $relationOrder->setRestaurant($this);
        }

        return $this;
    }

    public function removeRelationOrder(Order $relationOrder): self
    {
        if ($this->relation_order->removeElement($relationOrder)) {
            // set the owning side to null (unless already changed)
            if ($relationOrder->getRestaurant() === $this) {
                $relationOrder->setRestaurant(null);
            }
        }

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
            $relationCart->setRestaurant($this);
        }

        return $this;
    }

    public function removeRelationCart(Cart $relationCart): self
    {
        if ($this->relation_cart->removeElement($relationCart)) {
            // set the owning side to null (unless already changed)
            if ($relationCart->getRestaurant() === $this) {
                $relationCart->setRestaurant(null);
            }
        }

        return $this;
    }
}