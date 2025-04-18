<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Marqueur>
     */
    #[ORM\ManyToMany(targetEntity: Marqueur::class, inversedBy: 'parcours')]
    private Collection $marqueurs; 

    public function __construct()
    {
        $this->marqueurs = new ArrayCollection(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection<int, Marqueur>
     */
    public function getMarqueurs(): Collection
    {
        return $this->marqueurs;
    }

    public function addMarqueur(Marqueur $marqueur): static
    {
        if (!$this->marqueurs->contains($marqueur)) {
            $this->marqueurs->add($marqueur);
        }

        return $this;
    }

    public function removeMarqueur(Marqueur $marqueur): static
    {
        $this->marqueurs->removeElement($marqueur);
        return $this;
    }
}
