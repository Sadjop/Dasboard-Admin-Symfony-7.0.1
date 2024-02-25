<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $product_title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $product_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail_product = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $product_create = null;

    #[ORM\Column(nullable: true)]
    private ?float $average_note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductTitle(): ?string
    {
        return $this->product_title;
    }

    public function setProductTitle(string $product_title): static
    {
        $this->product_title = $product_title;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->product_description;
    }

    public function setProductDescription(?string $product_description): static
    {
        $this->product_description = $product_description;

        return $this;
    }

    public function getThumbnailProduct(): ?string
    {
        return $this->thumbnail_product;
    }

    public function setThumbnailProduct(?string $thumbnail_product): static
    {
        $this->thumbnail_product = $thumbnail_product;

        return $this;
    }

    public function getProductCreate(): ?\DateTimeInterface
    {
        return $this->product_create;
    }

    public function setProductCreate(\DateTimeInterface $product_create): static
    {
        $this->product_create = $product_create;

        return $this;
    }

    public function getAverageNote(): ?float
    {
        return $this->average_note;
    }

    public function setAverageNote(?float $average_note): static
    {
        $this->average_note = $average_note;

        return $this;
    }

    #[ORM\Column(type: 'string')]
    private string $imageFilename;

    #[ORM\ManyToMany(targetEntity: Favlist::class, mappedBy: 'product')]
    private Collection $favlists;

    public function __construct()
    {
        $this->favlists = new ArrayCollection();
    }

    public function getimageFilename(): string
    {
        return $this->imageFilename;
    }

    public function setimageFilename(string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function __toString()
    {
        return $this->product_title;
    }

    /**
     * @return Collection<int, Favlist>
     */
    public function getFavlists(): Collection
    {
        return $this->favlists;
    }

    public function addFavlist(Favlist $favlist): static
    {
        if (!$this->favlists->contains($favlist)) {
            $this->favlists->add($favlist);
            $favlist->addProduct($this);
        }

        return $this;
    }

    public function removeFavlist(Favlist $favlist): static
    {
        if ($this->favlists->removeElement($favlist)) {
            $favlist->removeProduct($this);
        }

        return $this;
    }
}
