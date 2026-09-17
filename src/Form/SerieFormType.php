<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('lieu', TextType::class, [
                'label' => 'Lieu',
                'attr' => [
                    'list' => 'communes-list',
                    'autocomplete' => 'off'
                ],
            ])

            ->add('date_heure', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
