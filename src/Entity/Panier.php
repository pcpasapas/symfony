<?php

namespace App\Entity;

use App\Entity\Composant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanierRepository;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paniers')]
    private ?Admin $user = null;

    #[ORM\ManyToOne(fetch:'EAGER')]
    public ?Composant $alimentation = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $boitier = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:"EAGER")]
    private ?Composant $processeur = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:"EAGER")]
    private ?Composant $Carte_mere = null;

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
    public function getAlimentation(): ?Composant
    {
        return $this->alimentation;
    }

    public function setAlimentation(?Composant $alimentation): self
    {
        $this->alimentation = $alimentation;

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

    public function setComposant(?Composant $composant): self
    {
        $categorie = $composant->getCategorie()->getName();
        if ($categorie === 'Boitiers') {
            $this->boitier = $composant;
        }
        if ($categorie === 'Alimentations') {
            $this->alimentation = $composant;
        }
        if ($categorie === 'Processeurs') {
            $this->processeur = $composant;
        }
        if ($categorie === 'Cartes Mères') {
            $this->Carte_mere = $composant;
        }
        return $this;
    }

    public function getProcesseur(): ?Composant
    {
        return $this->processeur;
    }

    public function setProcesseur(?Composant $processeur): self
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getCarteMere(): ?Composant
    {
        return $this->Carte_mere;
    }

    public function setCarte_mere(?Composant $Carte_mere): self
    {
        $this->Carte_mere = $Carte_mere;

        return $this;
    }





}
