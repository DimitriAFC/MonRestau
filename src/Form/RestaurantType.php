<?php

namespace App\Form;

use App\Entity\Secteur;
use App\Entity\ZipCode;
use App\Entity\Restaurant;
use App\Entity\RestaurantType as EntityRestaurantType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('phone')
            ->add('adress')
            ->add('city')
            ->add('relation_zipcode')
            ->add('relation_secteur')
            ->add('relation_type')
            ->add('picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
