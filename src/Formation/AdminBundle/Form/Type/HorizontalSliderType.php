<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 27/05/2015
 * Time: 16:44
 */

namespace Formation\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HorizontalSliderType extends AbstractType{

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'horizontalSlider';
    }

}