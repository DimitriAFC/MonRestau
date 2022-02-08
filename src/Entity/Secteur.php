<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
class Secteur
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
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="relation_secteur")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity=InfoUser::class, mappedBy="relation_secteur")
     */
    private $infoUsers;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->infoUsers = new ArrayCollection();
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
            $restaurant->setRelationSecteur($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getRelationSecteur() === $this) {
                $restaurant->setRelationSecteur(null);
            }
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
            $infoUser->setRelationSecteur($this);
        }

        return $this;
    }

    public function removeInfoUser(InfoUser $infoUser): self
    {
        if ($this->infoUsers->removeElement($infoUser)) {
            // set the owning side to null (unless already changed)
            if ($infoUser->getRelationSecteur() === $this) {
                $infoUser->setRelationSecteur(null);
            }
        }

        return $this;
    }
}
