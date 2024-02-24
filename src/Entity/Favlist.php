<?php

namespace App\Entity;

use App\Repository\FavlistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavlistRepository::class)]
class Favlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $listName = null;

    #[ORM\ManyToOne(inversedBy: 'favlists')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListName(): ?string
    {
        return $this->listName;
    }

    public function setListName(string $listName): static
    {
        $this->listName = $listName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
