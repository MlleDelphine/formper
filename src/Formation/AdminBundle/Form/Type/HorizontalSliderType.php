<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 27/05/2015
 * Time: 16:44
 */

namespace Formation\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HorizontalSliderType extends AbstractType{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'extended_options'  => $options['extended_options']
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'extended_options'  =>  array()
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