<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $panier_bdd_name = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Composant::class)]
    private Collection $composants;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPanierBddName(): ?string
    {
        return $this->panier_bdd_name;
    }

    public function setPanierBddName(?string $panier_bdd_name): self
    {
        $this->panier_bdd_name = $panier_bdd_name;

        return $this;
    }
}
