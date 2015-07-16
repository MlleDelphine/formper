<?php

namespace Formation\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RequirementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('technology','genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Technology',
                'property' => 'name',
                'label' => 'Technologie',
                'multiple' => false,
                'placeholder' => 'Sélectionner',
                'required' => true
                ))
            ->add('level','genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Level',
                'property' => 'name',
                'label' => 'Niveau',
                'multiple' => false,
                'placeholder' => 'Sélectionner',
                'required' => true))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\FrontBundle\Entity\Requirement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_adminbundle_requirement';
    }
}
