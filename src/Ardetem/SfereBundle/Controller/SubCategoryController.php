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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SubCategoryController extends Controller{
    /**
     * @Route("/detail/{slug}",requirements={"slug"="[a-z0-9\-]+"}, name="sfere_subcategory_detail" ,options={"expose"=true})
     * @Template()
     */
    public function detailAction($slug, Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:SubCategoryTranslation');
        $subCategoryTrans=$repository->findOneBySlug($slug);
        $subCategory = $subCategoryTrans->getTranslatable();
        $category=$subCategory->getCategory();
        return array("category" => $category,"subCategory"=> $subCategory);
    }
} 