<?php

namespace App\Form;
use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => 'Entrez votre Nom'],'label_attr' =>['class'=> 'scroll'],'label' => 'Nom',])
            ->add('firstname',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => 'Entrez votre Prénom'],'label_attr' =>['class'=> 'scroll'],'label' => 'Prénom'])
            ->add('phone',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => 'Entrez votre Téléphone'],'label_attr' =>['class'=> 'scroll'], 'label' => 'Téléphone'])
            ->add('city',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => 'Entrez votre Ville'],'label_attr' =>['class'=> 'scroll'], 'label' => 'Ville'])
            ->add('address',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => 'Entrez votre adresse'],'label_attr' =>['class'=> 'scroll'], 'label' => 'Adresse'])
            ->add('zipcode',TextType::class,[ 'attr' => ['class' => 'scroll form-control','placeholder' => '00000'], 'label_attr' =>['class'=> 'scroll'],'label' => 'Code postal (5 chiffres)'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
