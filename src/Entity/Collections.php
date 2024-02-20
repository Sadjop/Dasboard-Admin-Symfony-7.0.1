<?php

namespace App\Entity;

use App\Repository\CollectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionsRepository::class)]
class Collections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $collection_name = null;

    #[ORM\ManyToMany(targetEntity: product::class, inversedBy: 'collections')]
    private Collection $collection_product;

    #[ORM\ManyToOne(inversedBy: 'collections')]
    private ?user $collection_user = null;

    public function __construct()
    {
        $this->collection_product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectionName(): ?string
    {
        return $this->collection_name;
    }

    public function setCollectionName(string $collection_name): static
    {
        $this->collection_name = $collection_name;

        return $this;
    }

    /**
     * @return Collection<int, product>
     */
    public function getCollectionProduct(): Collection
    {
        return $this->collection_product;
    }

    public function addCollectionProduct(product $collectionProduct): static
    {
        if (!$this->collection_product->contains($collectionProduct)) {
            $this->collection_product->add($collectionProduct);
        }

        return $this;
    }

    public function removeCollectionProduct(product $collectionProduct): static
    {
        $this->collection_product->removeElement($collectionProduct);

        return $this;
    }

    public function getCollectionUser(): ?user
    {
        return $this->collection_user;
    }

    public function setCollectionUser(?user $collection_user): static
    {
        $this->collection_user = $collection_user;

        return $this;
    }
}
