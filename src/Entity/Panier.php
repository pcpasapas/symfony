<?php

namespace App\Entity;

use App\Entity\Composant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanierRepository;
use ApiPlatform\Metadata\ApiResource;

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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Admin
    {
        return $this->user;
    }

    public function setUser(?Admin $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBoitier(): ?Composant
    {
        return $this->boitier;
    }

    public function setBoitier(?Composant $boitier): self
    {
        $this->boitier = $boitier;

        return $this;
    }



}
