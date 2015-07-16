<?php

namespace Formation\AdminBundle\Form;

use Formation\AdminBundle\Form\Type\BooleanType;
use Formation\AdminBundle\Form\Type\EuroType;
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
            ->add('name', 'text', array('label' => 'Nom :', 'required' => false))
            ->add('shortDescription', 'genemu_tinymce', array(
                'required' => false,
                'label' => 'Description courte'))
            ->add('longDescription', 'genemu_tinymce', array(
                'required' => false,
                'label' => 'Description complète'))
            ->add('price', new EuroType(), array('label' => 'Prix :'))
            ->add('published', new BooleanType(), array('label' => 'Publié',
                'required' => false))
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
                'placeholder' => 'Sélectionner',
                'required' => true
            ))
            ->add('technologies',  'genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Technology',
                'property' => 'name',
                'label' => 'Technologies concernées',
                'multiple' => true,
                'placeholder' => 'Sélectionner',
                'required' => false
            ))
            ->add('requirements', 'collection', array(
                'type' => new RequirementType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false
            ))
            ->add('sessions', 'collection', array(
                'type' => new SessionType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false
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
