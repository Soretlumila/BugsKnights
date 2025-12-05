<?php

namespace App\Entity;

use App\Repository\CardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardsRepository::class)]
class Cards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $game = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $areas = null;

    #[ORM\Column]
    private ?float $price = null;

    /**
     * @var Collection<int, CommandDetails>
     */
    #[ORM\OneToMany(targetEntity: CommandDetails::class, mappedBy: 'cards')]
    private Collection $commandDetails;

    public function __construct()
    {
        $this->commandDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAreas(): ?string
    {
        return $this->areas;
    }

    public function setAreas(string $areas): static
    {
        $this->areas = $areas;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, CommandDetails>
     */
    public function getCommandDetails(): Collection
    {
        return $this->commandDetails;
    }

    public function addCommandDetail(CommandDetails $commandDetail): static
    {
        if (!$this->commandDetails->contains($commandDetail)) {
            $this->commandDetails->add($commandDetail);
            $commandDetail->setCards($this);
        }

        return $this;
    }

    public function removeCommandDetail(CommandDetails $commandDetail): static
    {
        if ($this->commandDetails->removeElement($commandDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandDetail->getCards() === $this) {
                $commandDetail->setCards(null);
            }
        }

        return $this;
    }
}
