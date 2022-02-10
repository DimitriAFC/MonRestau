<?php

namespace App\Form;

use App\Entity\Delivery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('time')
            ->add('adress')
            ->add('city')
            ->add('totalPrice')
            ->add('shippingCost')
            ->add('livreur')
            ->add('relation_User')
            ->add('relation_zipcode')
            ->add('relation_status')
            ->add('relation_restaurant')
            ->add('relation_cart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Delivery::class,
        ]);
    }
}
