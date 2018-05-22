<?php

namespace SimBundle\Form;

use SimBundle\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarqueFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('marque')
        ->add('offre', EntityType::class, [
            'placeholder' => '--Select offre--',
            'class' => Offre::class
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SimBundle\Entity\Marque'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_marque_form_type';
    }
}
