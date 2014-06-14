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
    use ORMBehaviors\Sluggable\Sluggable;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

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

    public function setId($id){
        $this->id=$id;
    }

    public function getSluggableFields()
    {
        return [ 'name' ];
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
       return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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