<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/21/14
 * Time: 10:12 PM
 */

namespace Ardetem\SfereBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class User extends BaseUser{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
} 