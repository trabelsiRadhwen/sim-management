<?php

namespace SimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentReportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'SimBundle\Entity\AgentReporting'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'sim_bundle_agent_report_form_type';
    }
}
