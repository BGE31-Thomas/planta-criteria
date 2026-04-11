<?php
namespace App\Form;

use App\Entity\Observation;
use App\Form\ObservationCritereFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ObservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('lieu')
            ->add('date_heure', DateTimeType::class, [
                'date_label' => 'Date',
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