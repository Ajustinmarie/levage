<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder
               
                //->add('roles')
                ->add('name', TextType::class, [
                    'label' => 'Initial',
                    'constraints'=>new Length([
                        'min'=>2,
                        'max'=>30
                    ]),
                    'attr'=>[
                        'placeholder'=>'Merci de saisir les initial'
                    ]
                ])

                ->add('fonction', ChoiceType::class, [
                    'label' => 'Fonction',
                    'choices' => [
                         'MAINTENANCE' => 'value1', // Displayed text => Actual value
                         'QUALITE' => 'value2',
                         'INDUS' => 'value3',
                         'AUTRES' => 'value4',
                        // Add more options as needed
                    ],
                    'placeholder' => 'Sélectionnez une fonction', // Optional: Add a placeholder option
                    'required' => true, // Make the field required
                ])


                ->add('email', EmailType::class,[
                    'label' => 'Email',
                    'constraints'=>new Length([
                        'min'=>2,
                        'max'=>30
                    ]),
                    'attr'=>[
                        'placeholder'=>'Merci de saisir votre email'
                    ]
                    ])

                ->add('password')              

               

                    ->add('password', RepeatedType::class,[
                        'type'=>PasswordType::class, 
                        'invalid_message'=>'Le mot de passe et la confirmation doivent etre identique',
                        'label' => 'Votre mot de passe',
                        'required'=>true,
                        'first_options'=>[
                            'label'=>'Mot de passe',
                            'attr'=>[
                            'placeholder'=>'Merci de saisir votre mot de passe']
                        ],
                        'second_options'=>[
                            'label'=>'Confirmez votre mot de passe',  
                            'attr'=>[
                                'placeholder'=>'Merci de confirmer votre mot de passe.'  
                            ]
                        ]     
                    ])
                    
                    ->add('administrateur')

                    ->add('submit', SubmitType::class,[
                        'label'=>"S'inscrire"
                     ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
