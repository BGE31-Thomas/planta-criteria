<?php
namespace App\Form;

use App\Entity\Observation;
use App\Form\ObservationCritereFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ObservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

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
            
            ->add('observationsCritere', CollectionType::class, [
                'entry_type' => ObservationCritereFormType::class,
                'allow_add' => true,
                'by_reference' => false
            ]);
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
        ]);
    }
}