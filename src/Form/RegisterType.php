<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            // ->add('roles', HiddenType::class)
            // ->add('password', PasswordType::class)
            // ->add('passwordConfirm', PasswordType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class, [
                'label'=>'Email',
                'attr' => [
                    'placeholder' => 'Email'
                    ]
                ])
            ->add('password', RepeatedType::class, array(
                        'type' => PasswordType::class,
                        'first_options' => array(
                            'label' => 'Mot de passe', 
                            'attr' => [
                                'placeholder' => 'Mot de passe',
                                'class' => 'bg-primary'
                            ]),
                        'second_options' => array(
                            'label' => 'Confirmation du mot de passe', 
                            'attr' => [
                                'placeholder' => 'Confirmation du mot de passe',
                                'class' => 'bg-warning'
                            ]),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
