<?php

namespace Ardetem\SfereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/",name="sfere_home" ,options={"expose"=true})
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/company", name="sfere_company")
     * @Template()
     */
    public function companyAction(){
        return array();
    }

    /**
     * @Route("/product/subcatgory/{slug}",requirements={"slug"="[a-z\-]+"}, name="sfere_sub_category_product")
     * @Template()
     */
    public function productAction($slug){
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:SubCategory');
        $cat=$repository->findOneBySlug($slug);
        return array('products' => $cat->getProducts());
    }

    /**
     * @Route("/contact/client", name="sfere_contact_client")
     * @Template()
     */
    public function contactClientAction(){
        return array();
    }

    /**
     * @Route("/contact/info", name="sfere_contact_info")
     * @Template()
     */
    public function contactInfoAction(){
        return array();
    }

    /**
     * @Route("/news", name="sfere_news")
     * @Template()
     */
    public function newsAction(){
        return array();
    }
}
