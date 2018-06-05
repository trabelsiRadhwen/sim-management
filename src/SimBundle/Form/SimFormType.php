<?php

namespace SimBundle\Form;

use SimBundle\Entity\AgentCommercial;
use SimBundle\Entity\Marque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroSerie')
            ->add('marque', EntityType::class, [
                'placeholder' => '--Select marque--',
                'class' =>Marque::class
            ])
            ->add('etat', TextType::class, array(
                'data' => 'Inactif',
            ))
            ->add('agent', EntityType::class, [
                'placeholder' => '--Select agent commercial--',
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
