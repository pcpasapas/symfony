<?php

namespace App\Twig\Components;

use App\Repository\ComposantRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('card_composant')]
final class CardComposantComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable : true)]
    public $categorie = 1;

    public function __construct(private ComposantRepository $composantRepository)
    {

    }
    public function getComposants()
    {
        return $this->composantRepository->findBy(['categorie' => $this->categorie]);
    }
}
