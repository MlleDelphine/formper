<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FormationAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
