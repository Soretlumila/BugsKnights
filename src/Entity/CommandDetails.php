<?php

namespace App\Entity;

use App\Repository\CommandDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandDetailsRepository::class)]
class CommandDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cards $cards = null;

    #[ORM\ManyToOne(inversedBy: 'commandDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Command $command = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCards(): ?Cards
    {
        return $this->cards;
    }

    public function setCards(?Cards $cards): static
    {
        $this->cards = $cards;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): static
    {
        $this->command = $command;

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
}
