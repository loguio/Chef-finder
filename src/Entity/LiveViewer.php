<?php

namespace App\Entity;

use App\Repository\LiveViewerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiveViewerRepository::class)
 */
class LiveViewer
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
    private $accessCode;

    /**
     * @ORM\OneToOne(targetEntity=UserCustomer::class, mappedBy="liveViewer", cascade={"persist", "remove"})
     */
    private $userCustomer;

    /**
     * @ORM\ManyToOne(targetEntity=Live::class, inversedBy="liveViewers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $live;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccessCode(): ?string
    {
        return $this->accessCode;
    }

    public function setAccessCode(string $accessCode): self
    {
        $this->accessCode = $accessCode;

        return $this;
    }

    public function getUserCustomer(): ?UserCustomer
    {
        return $this->userCustomer;
    }

    public function setUserCustomer(?UserCustomer $userCustomer): self
    {
        // unset the owning side of the relation if necessary
        if ($userCustomer === null && $this->userCustomer !== null) {
            $this->userCustomer->setLiveViewer(null);
        }

        // set the owning side of the relation if necessary
        if ($userCustomer !== null && $userCustomer->getLiveViewer() !== $this) {
            $userCustomer->setLiveViewer($this);
        }

        $this->userCustomer = $userCustomer;

        return $this;
    }

    public function getLive(): ?Live
    {
        return $this->live;
    }

    public function setLive(?Live $live): self
    {
        $this->live = $live;

        return $this;
    }
}
