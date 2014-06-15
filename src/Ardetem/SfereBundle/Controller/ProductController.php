<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/26/14
 * Time: 5:14 PM
 */

namespace Ardetem\SfereBundle\Controller;


use Ardetem\SfereBundle\Entity\DownloadInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller{

    /**
     * @Route("/{slug}/show", name="sfere_product_show")
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

    /**
     * @Route("/download/{slug}",name="sfere_product_download")
     */
    public function downloadAction($slug){
        $userId= $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()
            ->getRepository('ArdetemSfereBundle:Product');
        $product=$repository->findOneBySlug($slug);
        $repository = $this->getDoctrine()->getRepository('ArdetemSfereBundle:Profile');
        $profile = $repository->findProfileByUserId($userId);
        if ($profile == null && false == $this->get('security.context')->isGranted('ROLE_ADMIN') ){
            // go to complete profile page.
            $this->get('session')->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('notice.complete_profile')
            );
            return $this->redirect($this->generateUrl('sfere_profile_edit'));
        }
        $counter=new DownloadInfo();
        $counter->setProfile($profile);
        $em = $this->getDoctrine()->getManager();
        $em->persist($counter);
        $em->flush();
        $filename=$product->getDocument()->getAbsolutePath();
        $response = new Response();

// Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($filename));
        $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($filename) . '";');
        $response->headers->set('Content-length', filesize($filename));

// Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent(readfile($filename));
        return $response;
    }
}