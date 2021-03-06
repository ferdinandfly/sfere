<?php

namespace Ardetem\SfereBundle\Controller;

use Ardetem\SfereBundle\Entity\Profile;
use Ardetem\SfereBundle\Form\Type\ProfileFormType;
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
     * @Route("/contact/info", name="sfere_contact_info")
     * @Template()
     */
    public function contactInfoAction(){
        return array();
    }


    /**
     * @Route("/contact", name="sfere_contact")
     * @Template()
     */
    public function contactAction(){
        return array();
    }

    /**
     * @Route("/news", name="sfere_news")
     * @Template()
     */
    public function newsAction(){
        $news = $this->getDoctrine()->getManager()->getRepository("ArdetemSfereBundle:News")->findAll();
        return array("news" => $news);
    }

    /**
     * @Route("/news/{id}", name="sfere_news_show")
     * @Template()
     */
    public function newsShowAction($id){
        $element = $this->getDoctrine()->getManager()->getRepository("ArdetemSfereBundle:News")->find($id);
        return array("element" => $element);
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

    /**
     * @Route("/profile/edit", name="sfere_profile_edit")
     * @Template()
     */
    public function profileEditAction(Request $request){
        $user=$this->get('security.context')->getToken()->getUser();
        $repository = $this->getDoctrine()->getRepository('ArdetemSfereBundle:Profile');
        $profile = $repository->findProfileByUserId($user ->getId());
        if ($profile == null ){
            $profile = new Profile();
        }
        $form = $this->createForm(new ProfileFormType(), $profile);
        if ('POST' == $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $profile->setUser($user);
                $em->persist($profile);
                $em->flush();
                return $this->redirect($this->generateUrl('sfere_profile_show'));
            }
        }
        return array('form' => $form->createView());
    }

    /**
     * @Route("/profile/show", name="sfere_profile_show")
     * @Template()
     */
    public function profileShowAction(Request $request)
    {
        $userId= $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('ArdetemSfereBundle:Profile');
        $profile = $repository->findProfileByUserId($userId);
        if ($profile == null ){
            return $this->redirect($this->generateUrl('sfere_profile_edit'));

        }
        return array('profile'=> $profile);
    }
}
