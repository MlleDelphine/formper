<?php

namespace Formation\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom :'))
            ->add('shortDescription')
            ->add('longDescription')
            ->add('price')
            ->add('published', null, array('required' => false))
            ->add('teacher', 'genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Teacher',
                'property' => 'name',
                'label' => 'Formateur',
                'multiple' => false,
                'placeholder' => 'Sélectionner',
                'required' => false
            ))
            ->add('level',  'genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Level',
                'property' => 'name',
                'label' => 'Niveau',
                'multiple' => false,
                'placeholder' => 'Sélectionner'
            ))
            ->add('technologies',  'genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Technology',
                'property' => 'name',
                'label' => 'Technologies concernées',
                'multiple' => true,
                'placeholder' => 'Sélectionner'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\FrontBundle\Entity\Formation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_adminbundle_formation';
    }
}
