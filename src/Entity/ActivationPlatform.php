<?php

namespace App\Entity;

use App\Repository\ActivationPlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivationPlatformRepository::class)]
class ActivationPlatform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 26)]
    private ?string $name = null;

    /**
     * @var Collection<int, Offers>
     */
    #[ORM\OneToMany(targetEntity: Offers::class, mappedBy: 'activationPlatform')]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Offers>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offers $offer): static
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setActivationPlatform($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): static
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getActivationPlatform() === $this) {
                $offer->setActivationPlatform(null);
            }
        }

        return $this;
    }
}
