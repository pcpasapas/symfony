<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Composant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComposantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
            ])
            ->add('marque')
            ->add('modele')
            ->add('price', TextType::class, [
                'label' => 'Prix',
            ])
            ->add('format')
            ->add('dimensions')
            // ->add('image')
            ->add('couleur')

            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Composant::class,
        ]);
    }
}
