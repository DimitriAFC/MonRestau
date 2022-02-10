<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="relation_user")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="relation_User")
     */
    private $deliveries;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="user")
     */
    private $relation_cart;
    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="user")
     */
    private $relation_order;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="livreur")
     */
    private $livreur;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
        $this->relation_cart = new ArrayCollection();
        $this->relation_order = new ArrayCollection();
        $this->livreur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function __toString()
    {
       
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $restaurant->setRelationUser($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getRelationUser() === $this) {
                $restaurant->setRelationUser(null);
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
            $delivery->setRelationUser($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getRelationUser() === $this) {
                $delivery->setRelationUser(null);
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
            $relationCart->setUser($this);
        }

        return $this;
    }

    public function removeRelationCart(Cart $relationCart): self
    {
        if ($this->relation_cart->removeElement($relationCart)) {
            // set the owning side to null (unless already changed)
            if ($relationCart->getUser() === $this) {
                $relationCart->setUser(null);
            }
        }

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
            $relationOrder->setUser($this);
        }

        return $this;
    }

    public function removeRelationOrder(Order $relationOrder): self
    {
        if ($this->relation_order->removeElement($relationOrder)) {
            // set the owning side to null (unless already changed)
            if ($relationOrder->getUser() === $this) {
                $relationOrder->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getLivreur(): Collection
    {
        return $this->livreur;
    }

    public function addLivreur(Order $livreur): self
    {
        if (!$this->livreur->contains($livreur)) {
            $this->livreur[] = $livreur;
            $livreur->setLivreur($this);
        }

        return $this;
    }

    public function removeLivreur(Order $livreur): self
    {
        if ($this->livreur->removeElement($livreur)) {
            // set the owning side to null (unless already changed)
            if ($livreur->getLivreur() === $this) {
                $livreur->setLivreur(null);
            }
        }

        return $this;
    }
}
