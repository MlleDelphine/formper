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
//            ->add('formation','genemu_jqueryselect2_entity', array(
//                'class' => 'FormationFrontBundle:Formation',
//                'property' => 'name',
//                'label' => 'Formation',
//                'multiple' => false,
//                'placeholder' => 'Sélectionner'))
            ->add('technology','genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Technology',
                'property' => 'name',
                'label' => 'Technologie',
                'multiple' => false,
                'placeholder' => 'Sélectionner'))
            ->add('level','genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:Level',
                'property' => 'name',
                'label' => 'Niveau',
                'multiple' => false,
                'placeholder' => 'Sélectionner'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
        return 'formation_frontbundle_requirement';
    }
}
