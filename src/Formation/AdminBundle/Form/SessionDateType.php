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
            ->add('dateEnd', 'date', array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy'))
            ->add('timeStart', 'time', array('label' => 'Heure de départ',
                'widget' => 'single_text',
                'input' => 'datetime'))
            ->add('timeEnd', 'time', array('label' => 'Heure de fin',
                'widget' => 'single_text',
                'input' => 'datetime'))
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
        return 'formation_adminbundle_sessiondate';
    }
}
