<?php

namespace App\Form;

use App\Entity\UserCustomer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserCustomerRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Nom",
                ),
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom',
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Prénom",
                ),
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un prénom',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Email",
                ),
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner un email',
                    ]),
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Numéro de téléphone",
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Mot de passe",
                    'class' => "pwdInput",
                    'data-toggle' => "password",
                ),
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => array(
                    'placeholder' => "Confirmez votre Mot de passe",
                    'class' => "pwdInput",
                    'data-toggle' => "password",
                ),
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Confirmation mot de passe',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCustomer::class,
        ]);
    }
}
