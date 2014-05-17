<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 8:40 PM
 */

namespace Ardetem\SfereBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ardetem\SfereBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product {
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string",unique=true, length=255, nullable=true)
     */
    private $slug;

    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Document", cascade={"persist","remove"},fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    protected  $image;

    /**
     * @var SubCategory
     *
     * @ORM\ManyToOne(targetEntity="SubCategory",inversedBy="products", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sub_category_id", referencedColumnName="id")
     * })
     */
    protected  $subCategory;


    protected $name;
    protected $description;
    protected $resume;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set category
     *
     * @param SubCategory $category
     */
    public function setSubCategory(SubCategory $category)
    {
        $this->subCategory = $category;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }


    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        if ($image != null )
            $this->image=$image;
        return $this;
    }

    public function __toString(){
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->translate()->getName();
    }

    /**
     * @return text
     */
    public function getDescription(){
        return $this->translate()->getDescription();
    }


    public function getResume(){
        return $this->translate()->getResume();
    }

    public function setName($name)
    {
        return $this->translate()->setName($name);
    }

    public function setDescription($desc){
        return $this->translate()->setDescription($desc);
    }


    public function setResume($res){
        return $this->translate()->setResume($res);
    }

    /**
     * @param Document $doc
     */
    public function setDocument(Document $doc){
        $this->translate()->setDocument($doc);
    }

    /**
     * @return Document
     */
    public function getDocument(){
        return  $this->translate()->getDocument();
    }
}