<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre Nom'], 'label' => 'Nom'])
        ->add('firstname', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre Prénom'], 'label' => 'Prénom'])
        ->add('email', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre email'],'label' => 'E-mail'])
        ->add('phone', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre Téléphone'],'label' => 'Téléphone'])
        ->add('city', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre Ville'],'label' => 'Ville'])
        ->add('address', TextType::class,[ 'attr' => ['class' => 'form-control','placeholder' => 'Entrez votre adresse'],'label' => 'Adresse'])
        ->add('zipcode', TextType::class,   ['attr'=>['class' => 'form-control','placeholder' => '00000'],'label' => 'Code postal (5 chiffres)',
                                    'constraints' => [  new NotBlank (['message' => 'Entez le code posal',]),
                                                        new Length(['min' => 5,'max' => 5,'exactMessage' => 'Vous etes limité à 5 caractères',])
                                                    ],
                                            ])
        ->add(  'plainPassword', PasswordType::class, ['mapped' => false,'attr' => ['placeholder' => 'Entrez votre Mdp',
                'class' => 'form-control'],'label' => 'Votre MDP','constraints' => [
                new NotBlank(['message' => 'Vous n\'avez pas entré votre MDP',]),
                new Length(['min' => 6,'minMessage' => 'Vous devez entrer 6 caractères minimum',
                            'max' => 50,'maxMessage' => 'Vous etes limité à 50 caractères']),],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
