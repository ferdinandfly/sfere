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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoryController extends Controller {

    /**
     * @Route("/sidebar",name="sfere_category_menu_bar" ,options={"expose"=true})
     * @Template()
     */
    public function sideBarAction($categorySlug=null, $subCategorySlug=null, $productSlug=null, Request $request)
    {
        $locale = $request->getLocale();
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:Category');
        $categories=$repository->findAllByLocale($locale);
        return array("categories"=> $categories,"categorySlug" =>$categorySlug, "subCategorySlug"=> $subCategorySlug, "productSlug" => $productSlug);
    }


    /**
     * @Route("/detail/{slug}",name="sfere_category_detail" ,options={"expose"=true})
     * @Template()
     */
    public function detailAction($slug, Request $request)
    {

        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:CategoryTranslation');
        $category=$repository->findOneBySlug($slug)->getTranslatable();
        return array("category"=> $category);
    }
} 