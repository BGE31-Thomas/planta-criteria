<?php
namespace App\Form;

use App\Entity\ObservationCritere;
use App\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationCritereFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'libelle',
                'label' => 'Statut',
                'multiple' => false,
                'placeholder' => 'Choisir un statut',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ObservationCritere::class,
        ]);
    }
}