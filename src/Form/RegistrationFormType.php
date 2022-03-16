<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType; 

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Prénom'])
        ->add('lastname', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Nom'])
        ->add('email', TextType::class,[ 'attr' => ['class' => 'form-control'],'label' => 'E-mail'])
        ->add('phone', TextType::class,[ 'attr' => ['class' => 'form-control'],'label' => 'Téléphone'])
        ->add('address', TextType::class,[ 'attr' => ['class' => 'form-control'],'label' => 'Adresse'])
        ->add('zipcode', TextType::class,[ 'attr' => ['class' => 'form-control'],'label' => 'Code postal'])
        ->add(  'RGPDConsent', CheckboxType::class, [
                'mapped' => false,'constraints' => [ new IsTrue([
                'message' => 'Tu dois cocher la case accepter.', ]),],
                'label'=> 'En cochant, j\'accepte les conditions ',])
        ->add(  'plainPassword', PasswordType::class, ['mapped' => false,'attr' => [
                'autocomplete' => 'new-password','class' => 'form-control'],'constraints' => [
                new NotBlank(['message' => 'Entre ton MDP',]),
                new Length(['min' => 4,'minMessage' => 'tu es limité à {{ limit }} charactères',
                            'max' => 4096,]),],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
