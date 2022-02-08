<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $shippingCost;

    /**
     * @ORM\ManyToOne(targetEntity=Livreur::class, inversedBy="relation_delivery")
     */
    private $livreur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deliveries")
     */
    private $relation_User;

    /**
     * @ORM\ManyToOne(targetEntity=ZipCode::class, inversedBy="deliveries")
     */
    private $relation_zipcode;

    /**
     * @ORM\ManyToMany(targetEntity=Status::class, inversedBy="deliveries")
     */
    private $relation_status;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="deliveries")
     */
    private $relation_restaurant;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="deliveries")
     */
    private $relation_cart;

    public function __construct()
    {
        $this->relation_status = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

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

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(float $shippingCost): self
    {
        $this->shippingCost = $shippingCost;

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }

    public function getRelationUser(): ?User
    {
        return $this->relation_User;
    }

    public function setRelationUser(?User $relation_User): self
    {
        $this->relation_User = $relation_User;

        return $this;
    }

    public function getRelationZipcode(): ?ZipCode
    {
        return $this->relation_zipcode;
    }

    public function setRelationZipcode(?ZipCode $relation_zipcode): self
    {
        $this->relation_zipcode = $relation_zipcode;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getRelationStatus(): Collection
    {
        return $this->relation_status;
    }

    public function addRelationStatus(Status $relationStatus): self
    {
        if (!$this->relation_status->contains($relationStatus)) {
            $this->relation_status[] = $relationStatus;
        }

        return $this;
    }

    public function removeRelationStatus(Status $relationStatus): self
    {
        $this->relation_status->removeElement($relationStatus);

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

    public function getRelationCart(): ?Cart
    {
        return $this->relation_cart;
    }

    public function setRelationCart(?Cart $relation_cart): self
    {
        $this->relation_cart = $relation_cart;

        return $this;
    }
}
