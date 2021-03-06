<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 2:20 PM
 */

namespace Ardetem\SfereBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="subcategory_trans")
 * @ORM\Entity
 */
class SubCategoryTranslation {

    use ORMBehaviors\Translatable\Translation;
    use ORMBehaviors\Sluggable\Sluggable;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var text resume
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    protected $resume;

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


    public function getResume(){
        return $this->resume;
    }

    public function setResume($resume){
        $this->resume=$resume;
    }

    public function getSluggableFields()
    {
        return [ 'name','id' ];
    }
} 