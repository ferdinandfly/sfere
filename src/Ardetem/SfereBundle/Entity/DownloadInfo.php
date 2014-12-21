<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/13/14
 * Time: 9:05 PM
 */

namespace Ardetem\SfereBundle\Entity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="download_info")
 */
class DownloadInfo {
    use ORMBehaviors\Timestampable\Timestampable;
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Profile
     *
     * @ORM\ManyToOne(targetEntity="Profile",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     * })
     */
    protected  $profile;

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
     * Set profile
     *
     * @param \Ardetem\SfereBundle\Entity\Profile $profile
     * @return DownloadInfo
     */
    public function setProfile(\Ardetem\SfereBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Ardetem\SfereBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
