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
            ->add('name', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'nom'])
            ->add('price', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'prix'])
            ->add('description', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'description'])
            ->add('title', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'title'])
            ->add('image', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'nom de l\'image'])

        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Lesson::class,]);
    }
}