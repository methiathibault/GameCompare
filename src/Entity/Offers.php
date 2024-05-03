<?php

namespace App\Entity;

use App\Repository\OffersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffersRepository::class)]
class Offers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $offerLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOfferLink(): ?string
    {
        return $this->offerLink;
    }

    public function setOfferLink(string $offerLink): static
    {
        $this->offerLink = $offerLink;

        return $this;
    }
}
