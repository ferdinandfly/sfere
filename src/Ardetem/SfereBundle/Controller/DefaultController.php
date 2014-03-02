<?php

namespace Ardetem\SfereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ArdetemSfereBundle:Default:index.html.twig', array('name' => $name));
    }
}
