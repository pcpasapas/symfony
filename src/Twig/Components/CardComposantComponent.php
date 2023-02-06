<?php

namespace App\Twig\Components;

use App\Repository\CategorieRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('card_composant')]
final class CardComposantComponent
{
    use DefaultActionTrait;

    public function __construct(private CategorieRepository $categorieRepository)
    {

    }
    public function getCategories() {
        return $this->categorieRepository->findAll();
    }
}
