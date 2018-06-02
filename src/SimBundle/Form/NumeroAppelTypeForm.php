<?php

namespace SimBundle\Form;

use SimBundle\Entity\Marque;
use SimBundle\Entity\NumeroAppel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumeroAppelTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroAppel')
            ->add('marque', EntityType::class, [
                'placeholder' => '--Select marque--',
                'class' => Marque::class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => NumeroAppel::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_numero_appel_type_form';
    }
}
