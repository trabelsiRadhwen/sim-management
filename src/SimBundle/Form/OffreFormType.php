<?php

namespace SimBundle\Form;

use SimBundle\Entity\Marque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('offre')
            ->add('description')
            ->add('marque', EntityType::class,[
               'placeholder' => '--Select marque--',
                'class' => Marque::class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'SimBundle\Entity\Offre'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_offre_form_type';
    }
}
