<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 8:40 PM
 */

namespace Ardetem\SfereBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=true)
     */
    private $name;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string",unique=true, length=255, nullable=true)
     */
    private $slug;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Document")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     * })
     */
    protected  $document;

    /**
     * @var SubCategory
     *
     * @ORM\ManyToOne(targetEntity="SubCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sub_category_id", referencedColumnName="id")
     * })
     */
    protected  $subCategory;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @return text
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @param $desc
     */
    public function setDescription($desc){
        $this->description=$desc;
    }

    /**
     * @param Document $doc
     */
    public function setDocument(Document $doc){
        $this->document=$doc;
    }

    /**
     * @return Document
     */
    public function getDocument(){
        return $this->document;
    }

    public function __toString(){
        return $this->name;
    }
}