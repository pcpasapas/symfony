<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $name = null;

    // #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Composant::class)]
    // private Collection $composants;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $panier_bdd_name = null;

    public function __construct()
    {
        // $this->composants = new ArrayCollection();
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
