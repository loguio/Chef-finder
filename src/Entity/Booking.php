<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postCode;

    /**
     * @ORM\ManyToOne(targetEntity=Box::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $box;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, mappedBy="booking", cascade={"persist", "remove"})
     */
    private $linkedOrder;

    /**
     * @ORM\ManyToOne(targetEntity=userChief::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Chief;

    /**
     * @ORM\ManyToOne(targetEntity=userCustomer::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Customer;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

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

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getBox(): ?Box
    {
        return $this->box;
    }

    public function setBox(?Box $box): self
    {
        $this->box = $box;

        return $this;
    }

    public function getLinkedOrder(): ?Order
    {
        return $this->linkedOrder;
    }

    public function setLinkedOrder(Order $linkedOrder): self
    {
        // set the owning side of the relation if necessary
        if ($linkedOrder->getBooking() !== $this) {
            $linkedOrder->setBooking($this);
        }

        $this->linkedOrder = $linkedOrder;

        return $this;
    }

    public function getChief(): ?userChief
    {
        return $this->Chief;
    }

    public function setChief(?userChief $Chief): self
    {
        $this->Chief = $Chief;

        return $this;
    }

    public function getCustomer(): ?userCustomer
    {
        return $this->Customer;
    }

    public function setCustomer(?userCustomer $Customer): self
    {
        $this->Customer = $Customer;

        return $this;
    }
}
