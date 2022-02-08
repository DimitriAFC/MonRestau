<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreurRepository::class)
 */
class Livreur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Vehicle::class, mappedBy="livreur")
     */
    private $relation_vehicle;

    /**
     * @ORM\OneToOne(targetEntity=InfoUser::class, inversedBy="livreur", cascade={"persist", "remove"})
     */
    private $relation_infoUser;

    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="livreur")
     */
    private $relation_delivery;

    public function __construct()
    {
        $this->relation_vehicle = new ArrayCollection();
        $this->relation_delivery = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getRelationVehicle(): Collection
    {
        return $this->relation_vehicle;
    }

    public function addRelationVehicle(Vehicle $relationVehicle): self
    {
        if (!$this->relation_vehicle->contains($relationVehicle)) {
            $this->relation_vehicle[] = $relationVehicle;
            $relationVehicle->setLivreur($this);
        }

        return $this;
    }

    public function removeRelationVehicle(Vehicle $relationVehicle): self
    {
        if ($this->relation_vehicle->removeElement($relationVehicle)) {
            // set the owning side to null (unless already changed)
            if ($relationVehicle->getLivreur() === $this) {
                $relationVehicle->setLivreur(null);
            }
        }

        return $this;
    }

    public function getRelationInfoUser(): ?InfoUser
    {
        return $this->relation_infoUser;
    }

    public function setRelationInfoUser(?InfoUser $relation_infoUser): self
    {
        $this->relation_infoUser = $relation_infoUser;

        return $this;
    }

    /**
     * @return Collection|Delivery[]
     */
    public function getRelationDelivery(): Collection
    {
        return $this->relation_delivery;
    }

    public function addRelationDelivery(Delivery $relationDelivery): self
    {
        if (!$this->relation_delivery->contains($relationDelivery)) {
            $this->relation_delivery[] = $relationDelivery;
            $relationDelivery->setLivreur($this);
        }

        return $this;
    }

    public function removeRelationDelivery(Delivery $relationDelivery): self
    {
        if ($this->relation_delivery->removeElement($relationDelivery)) {
            // set the owning side to null (unless already changed)
            if ($relationDelivery->getLivreur() === $this) {
                $relationDelivery->setLivreur(null);
            }
        }

        return $this;
    }
}
