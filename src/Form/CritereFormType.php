<?php

namespace App\Form;

use App\Entity\Critere;
use App\Entity\Source;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;


class CritereFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('organe', null, [
                'label' => 'Organe',
            ])
            ->add('description')

            ->add('source', EntityType::class, [
                'class' => Source::class,
                'choice_label' => 'nom',
                'label' => 'Source',
                'multiple' => false,
                'placeholder' => 'Choisir une source',
            ])
            
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All([
                        new Image([
                            'maxWidth' => 15000,
                            'maxWidthMessage' => "L'image doit faire {{ max_width }} pixels de large au maximum.",
                        ]),
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Critere::class,
        ]);
    }
}