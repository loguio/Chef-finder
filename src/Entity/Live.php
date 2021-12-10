<?php

namespace App\Entity;

use App\Repository\LiveRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiveRepository::class)
 */
class Live
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $private;

    /**
     * @ORM\ManyToOne(targetEntity=UserChief::class, inversedBy="lives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userChief;

    /**
     * @ORM\OneToMany(targetEntity=LiveViewer::class, mappedBy="live", orphanRemoval=true)
     */
    private $liveViewers;

    public function __construct()
    {
        $this->liveViewers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrivate(): ?bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): self
    {
        $this->private = $private;

        return $this;
    }

    public function getUserChief(): ?UserChief
    {
        return $this->userChief;
    }

    public function setUserChief(?UserChief $userChief): self
    {
        $this->userChief = $userChief;

        return $this;
    }

    /**
     * @return Collection|LiveViewer[]
     */
    public function getLiveViewers(): Collection
    {
        return $this->liveViewers;
    }

    public function addLiveViewer(LiveViewer $liveViewer): self
    {
        if (!$this->liveViewers->contains($liveViewer)) {
            $this->liveViewers[] = $liveViewer;
            $liveViewer->setLive($this);
        }

        return $this;
    }

    public function removeLiveViewer(LiveViewer $liveViewer): self
    {
        if ($this->liveViewers->removeElement($liveViewer)) {
            // set the owning side to null (unless already changed)
            if ($liveViewer->getLive() === $this) {
                $liveViewer->setLive(null);
            }
        }

        return $this;
    }
}
