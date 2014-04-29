<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/26/14
 * Time: 5:14 PM
 */

namespace Ardetem\SfereBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller{

    /**
     * @Route("/{slug}/show",requirements={"slug" = "[a-z0-9\-]+"}, name="sfere_product_show")
     * @Template()
     */
    public function showAction($slug, Request $request){
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:Product');
        $product=$repository->findOneBySlug($slug);
        $subCategory=$product->getSubCategory();
        $category=$subCategory->getCategory();
        return array("product" => $product,"category" => $category,"subCategory"=> $subCategory);
    }
}