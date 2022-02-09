<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('firstName',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Nom',
                ]
            ])
            ->add('LastName',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Prénom',
                ]
            ])
            ->add('adress',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'adresse',
                ]
            ])
            ->add('zipcode',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'code postal',
                ]
            ])
            ->add('city',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'ville',
                ]
            ])
            ->add('number',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'numéro de téléphone',
                ]
            ])
            ->add('time', TimeType::class, [
                'label'=>'A quelle heure souhaitez-vous être livré?',
                'widget' => 'single_text',
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'Valider la commande',
                'attr'=>[
                    'class'=>'btn',
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
