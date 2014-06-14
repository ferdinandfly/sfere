<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/1/14
 * Time: 10:13 PM
 */

namespace Ardetem\SfereBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News {

    use ORMBehaviors\Translatable\Translatable;
    use ORMBehaviors\Sluggable\Sluggable;
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getSluggableFields()
    {
        return [ 'name' ];
    }

    public function getSlug(){
        return $this->slug;
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
    public function setImage(Document $doc){
        $this->translate()->setImage($doc);
    }

    /**
     * @return Document
     */
    public function getImage(){
        return  $this->translate()->getImage();
    }
}
