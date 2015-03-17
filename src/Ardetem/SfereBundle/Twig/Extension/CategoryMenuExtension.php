<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/17 0017
 * Time: 下午 10:12
 */

namespace Ardetem\SfereBundle\Twig\Extension;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class CategoryMenuExtension extends \Twig_Extension{

    private $locale;
    private $em;
    public function __construct( Container $container , EntityManager $em){
        $this->locale =$container->get('request')->getLocale();
        $this->em = $em;
    }
    public function getName()
    {
        return 'sfere_category_menu_extension';
    }
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('category_menu', array($this, 'renderCategoryMenu'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            ))
        );
    }

    public function renderCategoryMenu(\Twig_Environment $twig)
    {
        $repository = $this->em->getRepository('ArdetemSfereBundle:Category');
        $categories=$repository->findAllByLocale($this->locale);
        return $twig->render(
            'ArdetemSfereBundle:Category:menuList.html.twig',
            array("categories"=> $categories)
        );
    }

}