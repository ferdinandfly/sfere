<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 8:33 PM
 */

namespace Ardetem\SfereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SubCategoryController extends Controller{

    /**
     * @Route("/detail/{id}",requirements={"id"="\d+"}, name="sfere_category_menu" ,options={"expose"=true})
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