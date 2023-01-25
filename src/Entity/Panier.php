<?php

namespace App\Entity;

use App\Entity\Composant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanierRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
#[ApiResource]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paniers')]
    private ?Admin $user = null;

    #[ORM\ManyToOne(inversedBy: 'paniers', targetEntity:Composant::class)]
    private ?Composant $boitier = null;

    #[ORM\ManyToOne]
    private ?Composant $Alimentation = null;
    #[Groups(['panier'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['panier'])]
    public function getUser(): ?Admin
    {
        return $this->user;
    }

    public function setUser(?Admin $user): self
    {
        $this->user = $user;

        return $this;
    }

    #[Groups(['panier'])]
    public function getBoitier(): ?Composant
    {
        return $this->boitier;
    }

    public function setBoitier(?Composant $boitier): self
    {
        $this->boitier = $boitier;

        return $this;
    }

    public function getAlimentation(): ?Composant
    {
        return $this->Alimentation;
    }

    public function setAlimentation(?Composant $Alimentation): self
    {
        $this->Alimentation = $Alimentation;

        return $this;
    }

    public function setComposant(?Composant $composant): self
    {
        $categorie = $composant->getCategorie()->getName();
        if ($categorie === 'Boitiers') {
            $this->boitier = $composant;
        }
        if ($categorie === 'Alimentations') {
            $this->Alimentation = $composant;
        }
        return $this;
    }





}
