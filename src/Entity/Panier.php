<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{

    #[ORM\ManyToOne(fetch:'EAGER')]
    public ?Composant $alimentation = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $boitier = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $Carte_mere = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $carte_graphique = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $ssd = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $hdd = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    public ?Composant $ram = null;
    /**
     * Summary of panier
     *
     * @phan-write-only
     */
    private Collection $panier;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paniers')]
    private ?Admin $user = null;

    #[ORM\ManyToOne(targetEntity:Composant::class, fetch:'EAGER')]
    private ?Composant $processeur = null;

    #[ORM\OneToOne(mappedBy: 'panier', cascade: ['persist', 'remove'])]
    private ?Jeu $jeu = null;

    public function __construct()
    {
        $this->panier = new ArrayCollection();
    }

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
        if ($categorie === 'Cartes Graphiques') {
            $this->carte_graphique = $composant;
        }
        if ($categorie === 'Disque Dur SSD') {
            $this->ssd = $composant;
        }
        if ($categorie === 'Disque Dur HDD') {
            $this->hdd = $composant;
        }
        if ($categorie === 'Mémoire Ram') {
            $this->ram = $composant;
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

    public function setCarteMere(?Composant $Carte_mere): self
    {
        $this->Carte_mere = $Carte_mere;

        return $this;
    }

    public function getCarteGraphique(): ?Composant
    {
        return $this->carte_graphique;
    }

    public function setcarteGraphique(?Composant $carte_graphique): self
    {
        $this->carte_graphique = $carte_graphique;

        return $this;
    }

    public function getssd(): ?Composant
    {
        return $this->ssd;
    }

    public function setssd(?Composant $ssd): self
    {
        $this->ssd = $ssd;

        return $this;
    }

    public function getHdd(): ?Composant
    {
        return $this->hdd;
    }

    public function setHdd(?Composant $hdd): self
    {
        $this->hdd = $hdd;

        return $this;
    }

    public function getRam(): ?Composant
    {
        return $this->ram;
    }

    public function setRam(?Composant $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getJeu(): ?Jeu
    {
        return $this->jeu;
    }

    public function setJeu(Jeu $jeu): self
    {
        // set the owning side of the relation if necessary
        if ($jeu->getPanier() !== $this) {
            $jeu->setPanier($this);
        }

        $this->jeu = $jeu;

        return $this;
    }
}
