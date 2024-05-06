<?php

namespace App\Entity;

use App\Repository\NPlateformsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NPlateformsRepository::class)]
class NPlateforms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, inversedBy: 'nPlateforms')]
    private Collection $plateform;

    public function __construct()
    {
        $this->plateform = new ArrayCollection();
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
     * @return Collection<int, Game>
     */
    public function getPlateform(): Collection
    {
        return $this->plateform;
    }

    public function addPlateform(Game $plateform): static
    {
        if (!$this->plateform->contains($plateform)) {
            $this->plateform->add($plateform);
        }

        return $this;
    }

    public function removePlateform(Game $plateform): static
    {
        $this->plateform->removeElement($plateform);

        return $this;
    }
}
