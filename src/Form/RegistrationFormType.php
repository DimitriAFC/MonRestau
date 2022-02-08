<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Livreur' => 'ROLE_LIVREUR',
                    'Restaurant' => 'ROLE_RESTAURATEUR'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Acceptez les termes et conditions',
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'label'=> false,
                'invalid_message'=>'les mots de passes ne correspondent pas',
                'required'=>true,
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe est trop court {{ limit }} caractéres',
                        // max length allowed by Symfony for security reasons
                        'max' => 40,
                    ]),
                ],
                'first_options'=>[
                    'label' => false,
                    'attr'=>[
                    'placeholder'=>'Veuillez saisir votre mot de passe',
                    'class'=> 'form-control w-100 mb-2',
                    ],
                ],
                'second_options'=>[
                    'label' => false,
                    'attr'=>[
                    'placeholder'=>'Veuillez confirmez votre mot de passe',
                    'class'=> 'form-control w-100 mb-3',
                    ],
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
