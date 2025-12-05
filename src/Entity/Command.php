<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $userId = null;

    /**
     * @var Collection<int, CommandDetails>
     */
    #[ORM\OneToMany(targetEntity: CommandDetails::class, mappedBy: 'command')]
    private Collection $commandDetails;

    public function __construct()
    {
        $this->commandDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): static
    {
        $this->userId = $userId;

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
            $commandDetail->setCommand($this);
        }

        return $this;
    }

    public function removeCommandDetail(CommandDetails $commandDetail): static
    {
        if ($this->commandDetails->removeElement($commandDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandDetail->getCommand() === $this) {
                $commandDetail->setCommand(null);
            }
        }

        return $this;
    }
}
