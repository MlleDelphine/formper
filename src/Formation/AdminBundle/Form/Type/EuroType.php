<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 22/05/2015
 * Time: 11:22
 */

namespace Formation\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EuroType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('precision' => 2
        ));
    }

    public function getParent()
    {
        return 'number';
    }

    public function getName()
    {
        return 'euro';
    }
}