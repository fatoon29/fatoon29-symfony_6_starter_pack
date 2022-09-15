<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit contenir au minimum {{ limit }} lettres',
                    ]),
                ],
            ])
            
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit contenir au minimum {{ limit }} lettres',
                    ]),
                ],
            ])
            ->add('email', EmailType::class)
            
            ->add('phone', TelType::class, [
                'label' => 'Téléphone ',
                'constraints' => [
                    new NotBlank(),
                ],
            ])

            ->add('subject', TextType::class, [
                'label' => 'Objet ',
                'constraints' => [
                    new NotBlank(),
                ],
            ])

            ->add("message", TextareaType::class, [
                'label' => 'Message',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
