<?php

namespace SimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SimFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroSerie', NumberType::class)
            ->add('marque',null, [
                'placeholder' => '--Select marque--'
            ])
            ->add('offre', null, [
                'placeholder' => '--Select offre--'
            ])
            ->add('numeroAppel',NumberType::class)
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Inactif' => 'Inactif',
                    'Actif' => 'Actif'
                ]
            ])
        ->add('agent', null, [
            'placeholder' => '--select agent--'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SimBundle\Entity\Sim'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_sim_form_type';
    }
}
