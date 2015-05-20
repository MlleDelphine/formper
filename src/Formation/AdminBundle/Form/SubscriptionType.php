<?php

namespace Formation\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubscriptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('formation')
            ->add('session',  'genemu_jqueryselect2_entity', array(
                            'class' => 'FormationFrontBundle:Session',
                            'property' => 'name',
                            'label' => 'Session',
                            'multiple' => false
            ))
            ->add('status', 'genemu_jqueryselect2_entity', array(
                            'class' => 'FormationFrontBundle:SessionStatus',
                            'property' => 'name',
                            'label' => 'Statut',
                            'multiple' => false
            ))
            ->add('user', 'genemu_jqueryselect2_entity', array(
                            'class' => 'FormationUserBundle:User',
                            'property' => 'name',
                            'label' => 'Membre',
                            'multiple' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\FrontBundle\Entity\Subscription'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_adminbundle_subscription';
    }
}
