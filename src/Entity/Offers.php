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

    #[ORM\ManyToOne(inversedBy: 'offers')]
    private ?Game $game = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $discount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $edition = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    private ?Platform $platform = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    private ?ActivationPlatform $activationPlatform = null;

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(?string $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getActivationPlatform(): ?ActivationPlatform
    {
        return $this->activationPlatform;
    }

    public function setActivationPlatform(?ActivationPlatform $activationPlatform): static
    {
        $this->activationPlatform = $activationPlatform;

        return $this;
    }
}
