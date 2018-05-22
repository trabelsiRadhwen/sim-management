<?php

namespace SimBundle\Form;

use SimBundle\Entity\AgentCommercial;
use SimBundle\Entity\Marque;
use SimBundle\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use const true;


class SimFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroSerie')
            ->add('marque',EntityType::class, [
                'placeholder' => '--Select marque--',
                'class' => Marque::class,
            ])
            ->add('numeroAppel')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Inactif' => 'Inactif',
                    'Actif' => 'Actif'
                ]
            ])
            ->add('agent', EntityType::class, [
                'placeholder' => '--select agent--',
                'class' => AgentCommercial::class
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
