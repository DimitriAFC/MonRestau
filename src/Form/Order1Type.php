<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Order1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('LastName')
            ->add('adress')
            ->add('zipcode')
            ->add('city')
            ->add('status')
            ->add('total')
            ->add('shipping')
            ->add('date')
            ->add('time')
            ->add('number')
            ->add('user')
            ->add('restaurant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
