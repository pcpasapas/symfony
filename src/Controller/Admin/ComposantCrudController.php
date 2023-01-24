<?php

namespace App\Controller\Admin;

use App\Entity\Composant;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            'price',
            'format',
            'dimensions',
            'couleur',
            'puissance'

        ];
    }

}
