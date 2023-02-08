<?php

namespace App\Twig\Components;

use App\Repository\CategorieRepository;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent('select_categorie')]
final class SelectCategorieComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable : true)]
    public $categorieDebut = 1;

    public function __construct(private CategorieRepository $categorieRepository)
    {

    }
    public function getCategories() {
        return $this->categorieRepository->findAll();
    }

}
