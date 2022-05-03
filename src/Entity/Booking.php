<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeInterface;
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
     * @ORM\Column(type="string", length=255)
     */
    private ?string $status;

    /**
     * @ORM\ManyToOne(targetEntity=Box::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    public ?Box $box;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, mappedBy="booking", cascade={"persist", "remove"})
     */
    public ?Order $linkedOrder;

    /**
     * @ORM\Column(type="integer")
     */
    public ?int $box_quantity;

    /**
     * @ORM\Column(type="date")
     */
    public ?DateTimeInterface $date;

    /**
     * @ORM\Column(type="time")
     */
    public ?DateTimeInterface $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $delivery_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $appointment_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $customerId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $chiefId;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBoxQuantity(): ?int
    {
        return $this->box_quantity;
    }

    public function setBoxQuantity(int $box_quantity): self
    {
        $this->box_quantity = $box_quantity;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): self
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function getAppointmentAddress(): ?string
    {
        return $this->appointment_address;
    }

    public function setAppointmentAddress(string $appointment_address): self
    {
        $this->appointment_address = $appointment_address;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(string $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getChiefId(): ?string
    {
        return $this->chiefId;
    }

    public function setChiefId(string $chiefId): self
    {
        $this->chiefId = $chiefId;

        return $this;
    }
}
