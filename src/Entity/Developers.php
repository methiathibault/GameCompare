<?php

namespace App\Entity;

use App\Repository\DevelopersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevelopersRepository::class)]
class Developers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $developerName = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'developers')]
    private Collection $developer;

    public function __construct()
    {
        $this->developer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeveloperName(): ?string
    {
        return $this->developerName;
    }

    public function setDeveloperName(string $developerName): static
    {
        $this->developerName = $developerName;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getDeveloper(): Collection
    {
        return $this->developer;
    }

    public function addDeveloper(Game $developer): static
    {
        if (!$this->developer->contains($developer)) {
            $this->developer->add($developer);
            $developer->setDevelopers($this);
        }

        return $this;
    }

    public function removeDeveloper(Game $developer): static
    {
        if ($this->developer->removeElement($developer)) {
            // set the owning side to null (unless already changed)
            if ($developer->getDevelopers() === $this) {
                $developer->setDevelopers(null);
            }
        }

        return $this;
    }
}
