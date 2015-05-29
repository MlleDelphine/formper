<?php

namespace Formation\AdminBundle\Form;

use Formation\AdminBundle\Form\Type\HorizontalSliderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SessionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom :',
                'required' => true))
            ->add('places', new HorizontalSliderType(), array('required' => true,
                'label' => 'Nombre de places'
             ))
            ->add('status', 'genemu_jqueryselect2_entity', array(
                'class' => 'FormationFrontBundle:SessionStatus',
                'property' => 'name',
                'label' => 'Etat',
                'multiple' => false,
                'placeholder' => 'Sélectionner',
                'required' => false))
            ->add('sessionDates','collection', array(
                'type' => new SessionDateType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => true
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\FrontBundle\Entity\Session'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_frontbundle_session';
    }
}
