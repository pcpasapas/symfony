<?php

namespace App\Twig\Components;

use App\Entity\Composant;
use App\Repository\CategorieRepository;
use App\Repository\ComposantRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent('select_categorie')]
final class SelectCategorieComponent
{
    use DefaultActionTrait;

    public Composant $composant;

    #[LiveProp(writable: true)]
    public $categorie = ['id' => 1];

    public function __construct(
        private CategorieRepository $categorieRepository,
        private ComposantRepository $composantRepository
    )
    {

    }
    public function getCategories() {
        return $this->categorieRepository->findAll();
    }

    public function getComposants()
    {
        dump($this->composantRepository->findBy(['categorie' => 1]));
        return $this->composantRepository->findBy(['categorie' => 1]);
    }
}
