<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 22/05/2015
 * Time: 09:59
 */

namespace Formation\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BooleanType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getParent()
    {
        return 'checkbox';
    }

    public function getName()
    {
        return 'boolean';
    }
}