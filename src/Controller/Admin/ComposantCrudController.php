<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Composant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ComposantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Composant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('categorie'),
            TextField::new('marque'),
            TextField::new('modele'),
            'modele_min',
            'id',
            'price',
            'format',
            'dimensions',
            'couleur',
            'cg_processeur',
            'puissance',
            'socket',
            'lien',

        ];
    }
}
