<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 9:41 PM
 */

namespace Ardetem\SfereBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
/**
 * @ORM\Table(name="product_trans")
 * @ORM\Entity
 */
class ProductTranslation {
    use ORMBehaviors\Translatable\Translation;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string
     * @return null
     */
    public function setName($name)
    {
        $this->name = $name;
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
} 