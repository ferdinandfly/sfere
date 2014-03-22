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
     * @Route("/product/subcatgory/{id}",requirements={"id"="\d+"}, name="sfere_sub_category_product")
     * @Template()
     */
    public function productAction($id){
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:SubCategory');
        $cat=$repository->findOneById($id);
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
