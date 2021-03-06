<?php
namespace App\Form;
use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,['attr' => ['class' => 'scroll form-control'],'label_attr' =>['class'=> 'scroll'], 'label' => 'Prénom'])
            ->add('start', DateTimeType::class,['date_widget'=>'single_text','attr' => ['class'=>'scroll'],'label_attr' =>['class'=> 'scroll'],'label' => 'Jour & Heure'],)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Booking::class,]);
    }
}