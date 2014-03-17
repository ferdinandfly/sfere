<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/16/14
 * Time: 10:29 AM
 */

namespace Ardetem\SfereBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="document_trans")
 * @ORM\Entity
 */
class DocumentTranslation {
    use ORMBehaviors\Translatable\Translation;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param  string
     * @return null
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

} 