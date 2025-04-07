<?php

namespace App\Form;

use App\Entity\Fruits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FruitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Name', TextType::class, [
            'label' => 'Nom du fruit'
        ])
        ->add('Occupation', TextType::class, [
            'label' => 'Occupation'
        ])
        ->add('Age', IntegerType::class, [
            'label' => 'Son age'
        ])
        ->add('Evenement', TextType::class, [
            'label' => 'Quel évènement as-tu fixé ?'
        ])
        ->add('Date', DateTimeType::class, [
            'label' => 'A quel date as-tu fixé ?'
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Ajouter',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fruits::class,
        ]);
    }
}
