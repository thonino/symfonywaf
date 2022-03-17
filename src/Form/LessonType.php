<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Nom'])
            ->add('price', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Prix'])
            ->add('title', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Titre'])
            ->add('description', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'Description'])
            ->add('image', TextType::class,[ 'attr' => ['class' => 'form-control'], 'label' => 'nom du fichier jpg'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
