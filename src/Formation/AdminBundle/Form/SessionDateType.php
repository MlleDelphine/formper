<?php

namespace Formation\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SessionDateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateStart', 'date', array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy'))
            ->add('dateEnd', 'text', array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy'))
            ->add('timeStart', 'text', array('label' => 'Heure de départ'))
            ->add('timeEnd', 'text', array('label' => 'Heure de fin'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\FrontBundle\Entity\SessionDate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_frontbundle_sessiondate';
    }
}
