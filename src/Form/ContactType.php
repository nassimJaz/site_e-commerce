<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=> "Votre prénom",
                'attr'=> [
                    'placeholder' => "John"
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => "Pork"
                ]
            ])
            ->add('phone')
            ->add('email')
            ->add('content', TextareaType::class, [
                'label'=>"Votre message"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
