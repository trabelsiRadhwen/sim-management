<?php

namespace SimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CinFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin')
            ->add('nom')
            ->add('prenom')
            ->add('dob', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('place');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SimBundle\Entity\Cin'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_cin_form_type';
    }
}
