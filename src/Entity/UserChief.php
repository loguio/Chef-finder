<?php

namespace App\Entity;

use App\Repository\UserChiefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserChiefRepository::class)
 */
class UserChief
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
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $company;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="chief", orphanRemoval=true)
     */
    private ArrayCollection $bookings;

    /**
     * @ORM\OneToMany(targetEntity=Live::class, mappedBy="userChief", orphanRemoval=true)
     */
    private ArrayCollection $lives;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $slogan;

    /**
     * @ORM\Column(type="json")
     */
    private array $equipments = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $picture;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->lives = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setChief($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getChief() === $this) {
                $booking->setChief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Live[]
     */
    public function getLives(): Collection
    {
        return $this->lives;
    }

    public function addLive(Live $live): self
    {
        if (!$this->lives->contains($live)) {
            $this->lives[] = $live;
            $live->setUserChief($this);
        }

        return $this;
    }

    public function removeLive(Live $live): self
    {
        if ($this->lives->removeElement($live)) {
            // set the owning side to null (unless already changed)
            if ($live->getUserChief() === $this) {
                $live->setUserChief(null);
            }
        }

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getEquipments(): ?array
    {
        return $this->equipments;
    }

    public function setEquipments(array $equipments): self
    {
        $this->equipments = $equipments;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
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
}
