<?php

namespace App\Entity;

use App\Repository\ZipCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZipCodeRepository::class)
 */
class ZipCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $number;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class, mappedBy="relation_zipcode")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity=InfoUser::class, mappedBy="relation_zipcode")
     */
    private $infoUsers;

    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="relation_zipcode")
     */
    private $deliveries;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->infoUsers = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->addRelationZipcode($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            $restaurant->removeRelationZipcode($this);
        }

        return $this;
    }

    /**
     * @return Collection|InfoUser[]
     */
    public function getInfoUsers(): Collection
    {
        return $this->infoUsers;
    }

    public function addInfoUser(InfoUser $infoUser): self
    {
        if (!$this->infoUsers->contains($infoUser)) {
            $this->infoUsers[] = $infoUser;
            $infoUser->setRelationZipcode($this);
        }

        return $this;
    }

    public function removeInfoUser(InfoUser $infoUser): self
    {
        if ($this->infoUsers->removeElement($infoUser)) {
            // set the owning side to null (unless already changed)
            if ($infoUser->getRelationZipcode() === $this) {
                $infoUser->setRelationZipcode(null);
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
            $delivery->setRelationZipcode($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getRelationZipcode() === $this) {
                $delivery->setRelationZipcode(null);
            }
        }

        return $this;
    }
}
