<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/13/14
 * Time: 10:10 PM
 */

namespace Ardetem\SfereBundle\Repository;
use Doctrine\ORM\EntityRepository;

class ProfileRepository extends EntityRepository{
    public function findProfileByUserId($userId){
        $qb=$this->getEntityManager()->createQueryBuilder();
        $qb->select(array('p'))
            ->from('ArdetemSfereBundle:Profile','p')
            ->where('IDENTITY(p.user) =:id')
            ->setParameter('id',$userId);
        return $qb->getQuery()->getOneOrNullResult();
    }
} 