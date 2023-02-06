<?php

namespace App\Twig\Components;

use App\Entity\Composant;
use App\Repository\ComposantRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card_composant')]
final class CardComposantComponent
{
    use DefaultActionTrait;
    public $composant;

    public function __construct(private ComposantRepository $composantRepository)
    {

    }

    public function mount(Composant $composant)
    {
        $this->composant = $this->composantRepository->find(1);
    }

}
