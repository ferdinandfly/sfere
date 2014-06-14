<?php

namespace Ardetem\ImportBundle\Controller;

use Ardetem\SfereBundle\Entity\Category;
use Ardetem\SfereBundle\Entity\Document;
use Ardetem\SfereBundle\Entity\Product;
use Ardetem\SfereBundle\Entity\Profile;
use Ardetem\SfereBundle\Entity\SubCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\Sonata\UserBundle\Entity\User;
class DefaultController extends Controller
{
    /**
     * @Route("/",name="import_index" ,options={"expose"=true})
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/user",name="import_user")
     * @Template()
     */
    public function importUserAction()
    {
        set_time_limit(0);
        gc_enable();
        $logger = $this->get('logger');
        $oldem = $this->getDoctrine()->getManager('old');
        $stmt = $oldem->getConnection()->prepare("SELECT * FROM client where EMAIL != '' AND LOGINCLIENT != '' GROUP BY LOGINCLIENT" );
        $stmt->execute();
        $users = $stmt->fetchAll();
        $em = $this->getDoctrine()->getManager('default');
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        $counter=0;
        foreach($users as $user){
            $newUser = $em->getRepository('ApplicationSonataUserBundle:User')->findByEmail($user['EMAIL']);
            if ($newUser)
                continue;
            $counter++;
            $userManager = $this->get('fos_user.user_manager');
            $newUser=$userManager->createUser();
            $newUser->setEmail($user['EMAIL']);
            $newUser->setUsername($user['EMAIL']);
            $newUser->setPlainPassword($user['PWDCLIENT']);
            $newUser->setEnabled(true);
            $newUser->setRoles( array(User::ROLE_DEFAULT) );
            //$newUser= new User();
            $newUser->setFirstname($user['NOM']);
            $newUser->setLastname($user['PRENOM']);
            $newUser->setGender($user['civilite']);
            $newUser->setPhone($user['TELDIRECT']);
            $newUser->setCreatedAt(new \DateTime($user['regdate']));
            $userManager->updateUser($newUser);
            $profile = new Profile();
            $profile->setUser($newUser);
            $profile->setCompanyName($user['SOCIETE']);
            $profile->setCompanyAddress($user['AD'].' - '.$user['AD1']);
            $profile->setCity($user['VILLE']);
            $profile->setPostCode($user['CP']);
            $profile->setMobile($user['TELSOC']);
            $profile->setUrl($user['WEB']);
            $profile->setCountry($user['PAYS']);
            $profile->setActivity($user['ACTIVITE']);
            $profile->setSector($user['SECTEUR']);
            $profile->setReceiveMail(true);
            $em->persist($profile);
            if ($counter > 100){
                $logger->info($counter." user is saved");
                $counter = 0;
                $em->flush();
                $em->clear();
                gc_collect_cycles();
            }
        }
        if ($counter>0){
            $em->flush();
        }
        return $this->render('ArdetemImportBundle:Default:index.html.twig');
    }


    /**
     * @Route("/product",name="import_product")
     * @Template()
     */
    public function importProductAction()
    {
        $oldem = $this->getDoctrine()->getManager('old');
        $languages = array('zh_CN', 'es', 'fr', 'pl', 'en');
        $productTables = array('produit_cn', 'produit_es', 'produit_fr', 'produit_pl', 'produit_en');
        for ($i = 0; $i < count($languages); $i++) {
            $stmt = $oldem->getConnection()->prepare('SELECT * FROM ' . $productTables[$i]);
            $stmt->execute();
            $products = $stmt->fetchAll();
            $em = $this->getDoctrine()->getManager('default');

            foreach ($products as $product) {
                $newProduct = $em->getRepository('ArdetemSfereBundle:Product')->find($product['IDPROD']);
                if (!$newProduct) {
                    $newProduct = new Product();
                    $newProduct->setid($product['IDPROD']);
                    $image = new Document();
                    $imageUrl = $product['IMGPROD'];
                    $image->setPath(preg_replace('/.*produits\/([^"]+)\".*/', '$1', $imageUrl));
                    $em->persist($image);
                    $subcat = $em->getRepository('ArdetemSfereBundle:SubCategory')->find($product['IDCAT']);
                    $newProduct->setSubCategory($subcat);
                    $newProduct->setImage($image);
                }
                $newProduct->setName($product['LIBPROD']);
                $newProduct->translate($languages[$i])->setDescription($product['DESCRPROD']);
                $doc = new Document();
                $doc->setPath($languages[$i]."/".$product['NOMPDF']);
                $em->persist($doc);
                $newProduct->translate($languages[$i])->setDocument($doc);
                $newProduct->mergeNewTranslations();
                $em->persist($newProduct);
            }
            $em->flush();
        }

        return $this->render('ArdetemImportBundle:Default:index.html.twig');
    }

    /**
     * @Route("/category",name="import_category" )
     * @Template()
     */
    public function importCategoryAction()
    {
        $oldem = $this->getDoctrine()->getManager('old');
        $em = $this->getDoctrine()->getManager('default');
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        $familleTables = array('famille_cn',  'famille_es', 'famille_fr', 'famille_pl','famille_en');
        $categoryTables = array('categorie_cn','categorie_es', 'categorie_fr', 'categorie_pl', 'categorie_en' );
        $languages = array('zh_CN', 'es', 'fr', 'pl', 'en');
        for ($i = 0; $i < count($languages); $i++) {
            $stmt = $oldem->getConnection()->prepare('SELECT * FROM ' . $familleTables[$i]);
            $stmt->execute();
            $cats = $stmt->fetchAll();
            foreach ($cats as $cat) {
                $newCat = $em->getRepository('ArdetemSfereBundle:Category')->find($cat['IDFAM']);
                $elements = preg_split('/ \- /', $cat['LIBFAM']);
                if (!$newCat) {
                    $newCat = new Category();
                    $newCat->setId($cat['IDFAM']);
                    $newCat->setOrder($elements[0]);
                }
                if ($i == 0) {
                    $newCat->translate($languages[$i])->setSlug("chinese-" . $cat['IDFAM']);
                }
                $newCat->translate($languages[$i])->setName($elements[1]);
                $newCat->mergeNewTranslations();
                $em->persist($newCat);

            }
            $em->flush();
            $em->clear();

        }

        for ($i = 0; $i < count($languages); $i++) {
            $stmt = $oldem->getConnection()->prepare('SELECT * FROM ' . $categoryTables[$i]);
            $stmt->execute();
            $subCategories = $stmt->fetchAll();
            foreach ($subCategories as $cat) {
                $newSubCat = $em->getRepository('ArdetemSfereBundle:SubCategory')->find($cat['IDCAT']);
                if (!$newSubCat) {
                    $newSubCat = new SubCategory();
                    $newSubCat->setId($cat['IDCAT']);

                    $image = new Document();
                    $imageUrl = $cat['IMG'];
                    $image->setPath(preg_replace('/.*produits\/([^"]+)\".*/', '$1', $imageUrl));
                    $em->persist($image);
                    $newSubCat->setImage($image);
                    $category = $em->getRepository('ArdetemSfereBundle:Category')->find($cat['IDFAM']);
                    $newSubCat->setCategory($category);
                }
                if ($i == 0) {
                    $newSubCat->translate($languages[$i])->setSlug('chiniese-' . $cat['IDCAT']);
                }
                $newSubCat->translate($languages[$i])->setName($cat['LIBCAT']);
                $newSubCat->mergeNewTranslations();
                $em->persist($newSubCat);
            }
            $em->flush();
            $em->clear();
        }
        return $this->render('ArdetemImportBundle:Default:index.html.twig');
    }
}
