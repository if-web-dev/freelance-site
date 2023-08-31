<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'minlength' => '2',
                    'maxlenght' => '50',
                ],
                'label' => 'Votre Nom et Prénom',
                'label_attr' => [
                    'class' => 'text-dark'
                ],
                'attr' => [
                    'placeholder' => 'Nom et Prénom',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min'=> 2, 
                        'max' => 50,
                        'minMessage' => 'Votre nom et prénom doivent faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre nom et prénom ne doivent pas dépasser {{ limit }} caractères',
                    ])
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'minlength' => '2',
                    'maxlenght' => '180',
                ],
                'label' => 'Votre E-mail',
                'label_attr' => [
                    'class' => 'text-dark'
                ],
                'attr' => [
                    'placeholder' => 'Votre E-mail',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length([
                        'min'=> 6, 
                        'max' => 180,
                        'minMessage' => 'Votre email dois faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre ne doit  pas dépasser {{ limit }} caractères',
                    ])
                ],
            ])
            ->add('prestation', ChoiceType::class, [
                'choices' => [
                    'Visuel ou Logo' => "Visuel ou Logo",
                    'Site Vitrine' => "Site Vitrine",
                    'Site E-commerce' => "Site E-commerce",
                ],
                'placeholder' => '--Choisissez votre prestation--',
                'row_attr' => [
                    'class' => 'form-floating mb-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull()
                ],
                
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '50',
                    'maxlenght' => '2000',
                    'placeholder' => 'Votre Message',
                    'style' => "height: 150px"
                ],
                'label' => 'Votre Message',
                'label_attr' => [
                    'class' => 'text-dark'
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min'=> 50, 
                        'max' => 2000,
                        'minMessage' => 'Votre message doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre message ne doit pas dépasser {{ limit }} caractères',
                    ])
                ],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'contactForm',
                //'script_nonce_csp' => $nonceCSP,
                //'locale' => 'de',
            ]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
