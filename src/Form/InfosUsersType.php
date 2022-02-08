<?php

namespace App\Form;

use App\Entity\InfoUser;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class,
            ['label' => 'Prénom'])
            ->add('lastName')
            ->add('adress')
            ->add('city')
            // ->add('livreur')
            // ->add('relation_user')
            ->add('relation_secteur')
            ->add('relation_zipcode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoUser::class,
        ]);
    }
} 
