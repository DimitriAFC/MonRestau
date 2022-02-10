<?php

namespace App\Form;

use App\Entity\Delivery;
use App\Entity\Cart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('relation_cart',EntityType::class,[
                'label'=>false,
                'required'=>true,
                'class'=>Cart::class,
                'multiple'=>false,
                'expanded'=>true,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Delivery::class,
        ]);
    }
}
