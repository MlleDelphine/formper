<?php

namespace Formation\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FormationFrontBundle:Default:index.html.twig', array('name' => $name));
    }
}
