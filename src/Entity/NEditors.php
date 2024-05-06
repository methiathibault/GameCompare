<?php

namespace App\Entity;

use App\Repository\NEditorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NEditorsRepository::class)]
class NEditors
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
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'nEditors')]
    private Collection $editor;

    public function __construct()
    {
        $this->editor = new ArrayCollection();
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
    public function getEditor(): Collection
    {
        return $this->editor;
    }

    public function addEditor(Game $editor): static
    {
        if (!$this->editor->contains($editor)) {
            $this->editor->add($editor);
            $editor->setNEditors($this);
        }

        return $this;
    }

    public function removeEditor(Game $editor): static
    {
        if ($this->editor->removeElement($editor)) {
            // set the owning side to null (unless already changed)
            if ($editor->getNEditors() === $this) {
                $editor->setNEditors(null);
            }
        }

        return $this;
    }
}
