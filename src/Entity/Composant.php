<?php

namespace App\Entity;

use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ComposantRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ComposantRepository::class)]
// #[ApiResource]
class Composant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $marque = null;

    #[ORM\ManyToOne(inversedBy: 'composants', targetEntity: Categorie::class)]
    #[ORM\JoinColumn(nullable: false)]
    public ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    public ?string $modele = null;

    #[ORM\Column]
    public ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?string $format = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dimensions = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column(nullable: true)]
    private ?int $puissance = null;

        #[ORM\OneToMany(mappedBy: 'boitier', targetEntity: Panier::class)]
        private Collection $paniers;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->marque;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDimensions(): ?string
    {
        return $this->dimensions;
    }

    public function setDimensions(?string $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(?int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    // /**
    //  * @return Collection<int, Panier>
    //  */
    // public function getPaniers(): Collection
    // {
    //     return $this->paniers;
    // }

    // public function addPanier(Panier $panier): self
    // {
    //     if (!$this->paniers->contains($panier)) {
    //         $this->paniers->add($panier);
    //         $panier->setBoitier($this);
    //     }

    //     return $this;
    // }

    // public function removePanier(Panier $panier): self
    // {
    //     if ($this->paniers->removeElement($panier)) {
    //         // set the owning side to null (unless already changed)
    //         if ($panier->getBoitier() === $this) {
    //             $panier->setBoitier(null);
    //         }
    //     }

    //     return $this;
    // }
}
