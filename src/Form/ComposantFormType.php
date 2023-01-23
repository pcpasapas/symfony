<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Composant;
use App\Config\listes\FormatBoitier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ComposantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {

        $builder
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name'
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
