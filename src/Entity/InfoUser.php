<?php

namespace App\Entity;

use App\Repository\InfoUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfoUserRepository::class)
 */
class InfoUser
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\OneToOne(targetEntity=Livreur::class, mappedBy="relation_infoUser", cascade={"persist", "remove"})
     */
    private $livreur;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $relation_user;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="infoUsers")
     */
    private $relation_secteur;

    /**
     * @ORM\ManyToOne(targetEntity=Zipcode::class, inversedBy="infoUsers")
     */
    private $relation_zipcode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        // unset the owning side of the relation if necessary
        if ($livreur === null && $this->livreur !== null) {
            $this->livreur->setRelationInfoUser(null);
        }

        // set the owning side of the relation if necessary
        if ($livreur !== null && $livreur->getRelationInfoUser() !== $this) {
            $livreur->setRelationInfoUser($this);
        }

        $this->livreur = $livreur;

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

    public function getRelationSecteur(): ?Secteur
    {
        return $this->relation_secteur;
    }

    public function setRelationSecteur(?Secteur $relation_secteur): self
    {
        $this->relation_secteur = $relation_secteur;

        return $this;
    }

    public function getRelationZipcode(): ?Zipcode
    {
        return $this->relation_zipcode;
    }

    public function setRelationZipcode(?Zipcode $relation_zipcode): self
    {
        $this->relation_zipcode = $relation_zipcode;

        return $this;
    }
}
