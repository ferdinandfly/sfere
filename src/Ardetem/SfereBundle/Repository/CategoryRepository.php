<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/27/14
 * Time: 5:52 PM
 */

namespace Ardetem\SfereBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository{
    public function findAllByLocale($locale){
        $qb=$this->getEntityManager()->createQueryBuilder();
        $qb->select(array('c,ct,sc,sct'))
            ->from('ArdetemSfereBundle:Category','c')
            ->innerJoin('c.translations','ct')
            ->innerJoin('c.subCategories','sc')
            ->innerJoin('sc.translations','sct')
            ->where('ct.locale =:locale')
            ->andWhere("sct.locale = :locale")
            ->orderBy('c.order','asc')
            ->setParameter('locale',$locale);
        return $qb->getQuery()->getResult();
    }
} 