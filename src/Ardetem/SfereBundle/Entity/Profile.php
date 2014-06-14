<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/13/14
 * Time: 8:52 PM
 */

namespace Ardetem\SfereBundle\Entity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="Ardetem\SfereBundle\Repository\ProfileRepository")
 * @ORM\Table(name="profile")
 */
class Profile {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    protected  $user;

    /**
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    protected $mobile;

    /**
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    protected $companyName;

    /**
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    protected $companyAddress;

    /**
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    protected $postCode;

    /**
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    protected $city;

    /**
     * @var country
     * @ORM\Column(type="string",length=255)
     * @Assert\Country()
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="255")
     */
    protected $country;

    /**
     * @var String
     * @ORM\Column(type="text")
     */
    protected $url;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $receiveMail;

    /**
     * @var String
     * @ORM\Column(type="text")
     */
    protected $activity;

    /**
     * @var String
     * @ORM\Column(type="text")
     */
    protected $sector;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setActivity($act)
    {
        $this->activity=$act;
        return $this;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function setSector($sec)
    {
        $this->sector= $sec;
        return $this;

    }

    public function getSector()
    {
        return $this->sector;
    }
    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Profile
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyAddress
     *
     * @param string $companyAddress
     * @return Profile
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get companyAddress
     *
     * @return string 
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return Profile
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Profile
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Profile
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set receiveMail
     *
     * @param boolean $receiveMail
     * @return Profile
     */
    public function setReceiveMail($receiveMail)
    {
        $this->receiveMail = $receiveMail;

        return $this;
    }

    /**
     * Get receiveMail
     *
     * @return boolean 
     */
    public function getReceiveMail()
    {
        return $this->receiveMail;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Profile
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Profile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Profile
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function __toString()
    {
        return $this->companyName;
    }
}
