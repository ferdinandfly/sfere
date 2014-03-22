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
 * @ORM\Entity
 */
class Category {
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
     * @ORM\Column(name="slug", type="string", unique=true,length=255, nullable=true)
     */
    private $slug;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var text resume
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var integer $order
     *
     * @ORM\Column(name="order_number", type="integer", nullable=true)
     */
    private $order;

    /**
     * @ORM\OneToMany(targetEntity="SubCategory", mappedBy="category", cascade={"all"})
     */
    protected $subCategories;

    /**
     *
     */
    public function __construct(){
        $this->subCategories = new ArrayCollection();
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

    /**
     * @return text
     */
    public function getDescription(){
        return $this->description;
    }

    public function getResume(){
        return $this->resume;
    }

    public function setResume($resume){
        $this->resume=$resume;
    }


    public function getOrder(){
        $this->order;
    }
    public function setOrder($order){
        $this->order=$order;
    }

    /**
     * @param $desc
     */
    public function setDescription($desc){
        $this->description=$desc;
    }

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
    public function __toString(){
        return $this->name;
    }
} 