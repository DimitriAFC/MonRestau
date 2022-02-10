<?php

namespace App\Form;

use App\Entity\InfoUser;
use App\Entity\Secteur;
use App\Repository\SecteurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class,[
                'label' => false,
                'attr'=>[
                    'placeholder'=>'Prénom',
                    'class'=> 'form-control w-100 mb-2',
                    ],
            ])
            ->add('lastName',TextType::class,[
                'label' => false,
                'attr'=>[
                    'placeholder'=>'Nom',
                    'class'=> 'form-control w-100 mb-2',
                    ],
                ])
            ->add('adress',TextType::class,[
                'label' => false,
                'attr'=>[
                    'placeholder'=>'Adresse',
                    'class'=> 'form-control w-100 mb-2',
                    ],
            ])
            ->add('city',TextType::class,[
                'label' => false,
                'attr'=>[
                    'placeholder'=>'Ville',
                    'class'=> 'form-control w-100 mb-2',
                    ],
            ])
            // ->add('livreur')
            ->add('relation_zipcode',) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoUser::class,
        ]);
    }
} 
