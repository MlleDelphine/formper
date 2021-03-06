<?php

namespace Formation\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of MediaType
 *
 */
class MediaType extends \Sonata\MediaBundle\Form\Type\MediaType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }
    
    public function getParent()
    {
        return 'sonata_media_type';
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_media_type';
    }

}
