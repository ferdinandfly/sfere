<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/26/14
 * Time: 4:13 PM
 */

namespace Ardetem\SfereBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    public function findAllByKeywords($string, $locale){
        $qb=$this->getEntityManager()->createQueryBuilder();
        $qb->select(array('p'))
            ->from('ArdetemSfereBundle:Product','p')
            ->innerJoin('p.translations','pt')
            ->innerJoin('p.subCategory','sc')
            ->innerJoin('sc.category','c')
            ->where('pt.locale = :locale');

            $or_cond=$qb->expr()->orx();
            $searchColumn=array("p.name","pt.description","pt.resume");
            foreach($searchColumn as $column){
                $or_cond->add($qb->expr()->like($column,$qb->expr()->literal("%$string%")));
            }
            $qb->andWhere($or_cond);
        $qb->setParameter('locale',$locale);
        return $qb;
    }
} 