<?php

namespace Ardetem\SfereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/search", name="sfere_search")
     * @Template()
     */
    public function searchAction(Request $request){
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $qb=$em->getRepository("ArdetemSfereBundle:Product")->findAllByKeywords($request->request->get("searchword"),$locale);
        $paginator=$this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $qb,
            $this->get('request')->query->get('page',1),
            10
        );
        return array("pagination" => $pagination);
    }
}
