<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/1/14
 * Time: 10:14 PM
 */

namespace Ardetem\SfereBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="news_trans")
 * @ORM\Entity
 */
class NewsTranslation {

    use ORMBehaviors\Translatable\Translation;
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
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Document" ,cascade={"persist","remove"},fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    protected  $image;

    /**
     * Set name
     *
     * @param string $name
     * @return NewsTranslation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set description
     *
     * @param string $description
     * @return NewsTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return NewsTranslation
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        if ($image != null )
            $this->image=$image;
        return $this;
    }
}
