<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/14/14
 * Time: 11:13 PM
 */
namespace Ardetem\SfereBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="sub_category")
 * @ORM\Entity
 */
class SubCategory {
    use ORMBehaviors\Translatable\Translatable;
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;


    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="subCategories",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    protected $category;

    /**
     * @var integer $order
     *
     * @ORM\Column(name="order_number", type="integer", nullable=true)
     */
    private $order;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="subCategory", cascade={"all"},fetch="EAGER")
     */
    protected $products;

    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Document", cascade={"persist","remove"},fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    protected  $image;

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        if ($image != null )
            $this->image=$image;
        return $this;
    }

    /**
     *
     */
    public function __construct(){
        $this->products = new ArrayCollection();
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
     * Set category
     *
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

     /**
     * Add $product
     *
     * @param Product $product
     * @return subCategory
     */
    public function addProducts(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @param Product $product
     */
    public function removeProducts(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }


    public function getOrder(){
        $this->order;
    }
    public function setOrder($order){
        $this->order=$order;
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

} 