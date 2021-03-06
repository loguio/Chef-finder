<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MealRepository::class)
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $picture;

    /**
     * @ORM\OneToMany(targetEntity=Box::class, mappedBy="meal", orphanRemoval=true)
     */
    public Collection $boxes;

    /**
     * @ORM\ManyToOne(targetEntity=FoodCategory::class, inversedBy="meals")
     * @ORM\JoinColumn(nullable=false)
     */
    public ?FoodCategory $food_category;

    public function __construct()
    {
        $this->boxes = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Box[]
     */
    public function getBoxes(): Collection
    {
        return $this->boxes;
    }

    public function addBox(Box $box): self
    {
        if (!$this->boxes->contains($box)) {
            $this->boxes[] = $box;
            $box->setMeal($this);
        }

        return $this;
    }

    public function removeBox(Box $box): self
    {
        if ($this->boxes->removeElement($box)) {
            // set the owning side to null (unless already changed)
            if ($box->getMeal() === $this) {
                $box->setMeal(null);
            }
        }

        return $this;
    }

    public function getFoodCategory(): ?FoodCategory
    {
        return $this->food_category;
    }

    public function setFoodCategory(?FoodCategory $food_category): self
    {
        $this->food_category = $food_category;

        return $this;
    }
}
