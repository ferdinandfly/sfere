<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/14/14
 * Time: 11:13 PM
 */

namespace Ardetem\SfereBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Ardetem\SfereBundle\Repository\CategoryRepository")
 */
class Category {
    use ORMBehaviors\Translatable\Translatable;
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var integer $order
     *
     * @ORM\Column(name="order_number", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Document" ,cascade={"persist","remove"},fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    protected  $image;

    /**
     * @ORM\OneToMany(targetEntity="SubCategory", mappedBy="category", cascade={"all"},fetch="EAGER")
     */
    protected $subCategories;

    /**
     *
     */
    public function __construct(){
        $this->subCategories = new ArrayCollection();
    }

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

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
    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        return $this->translate()->setSlug($slug);
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->translate()->getSlug();
    }

    /**
     * Add subCategory
     *
     * @param SubCategory $subCategory
     * @return Category
     */
    public function addSubCategories(SubCategory $subCategory)
    {
        $this->subCategory[] = $subCategory;

        return $this;
    }

    /**
     * @param SubCategory $subCategory
     */
    public function removeSubCategories(SubCategory $subCategory)
    {
        $this->subCategories->removeElement($subCategory);
    }

    /**
     * Get subCategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }


    public function getOrder(){
        $this->order;
    }
    public function setOrder($order){
        $this->order=$order;
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
        $this->translate()->setName($name);
        return $this;
    }

    public function setDescription($desc){

        $this->translate()->setDescription($desc);
        return $this;
    }


    public function setResume($res){
        $this->translate()->setResume($res);
        return $this;
    }

} 