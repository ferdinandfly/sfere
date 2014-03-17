<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 7:42 PM
 */

namespace Ardetem\SfereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoryController extends Controller {

    /**
     * @Route("/menulist",name="sfere_category_menu" ,options={"expose"=true})
     * @Template()
     */
    public function menuListAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:Category');
        $categories=$repository->findAll();
        return array("categories"=> $categories);
    }

    /**
     * @Route("/detail/{id}",requirements={"id"="\d+"}, name="sfere_category_detail" ,options={"expose"=true})
     * @Template()
     */
    public function detailAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:Category');
        $category=$repository->findOneBy($id);
        return array("categories"=> $category);
    }
} 