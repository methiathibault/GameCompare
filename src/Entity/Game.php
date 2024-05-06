<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Offers>
     */
    #[ORM\OneToMany(targetEntity: Offers::class, mappedBy: 'game')]
    private Collection $offers;

    #[ORM\ManyToOne(inversedBy: 'developer')]
    private ?Developers $developers = null;

    /**
     * @var Collection<int, NPlateforms>
     */
    #[ORM\ManyToMany(targetEntity: NPlateforms::class, mappedBy: 'plateform')]
    private Collection $nPlateforms;

    #[ORM\ManyToOne(inversedBy: 'editor')]
    private ?NEditors $nEditors = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->nPlateforms = new ArrayCollection();
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
            $offer->setGame($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): static
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getGame() === $this) {
                $offer->setGame(null);
            }
        }

        return $this;
    }

    public function getDevelopers(): ?Developers
    {
        return $this->developers;
    }

    public function setDevelopers(?Developers $developers): static
    {
        $this->developers = $developers;

        return $this;
    }

    /**
     * @return Collection<int, NPlateforms>
     */
    public function getNPlateforms(): Collection
    {
        return $this->nPlateforms;
    }

    public function addNPlateform(NPlateforms $nPlateform): static
    {
        if (!$this->nPlateforms->contains($nPlateform)) {
            $this->nPlateforms->add($nPlateform);
            $nPlateform->addPlateform($this);
        }

        return $this;
    }

    public function removeNPlateform(NPlateforms $nPlateform): static
    {
        if ($this->nPlateforms->removeElement($nPlateform)) {
            $nPlateform->removePlateform($this);
        }

        return $this;
    }

    public function getNEditors(): ?NEditors
    {
        return $this->nEditors;
    }

    public function setNEditors(?NEditors $nEditors): static
    {
        $this->nEditors = $nEditors;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}
