<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function filterLinkAll($slug){

        return $this->createQueryBuilder('l')
            ->innerJoin('l.value','v')
            ->innerJoin('l.subcategory','s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug)
            ->addSelect('v','s')
            ->orderBy('v.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function filterValue($slug)
    {

        return $this->createQueryBuilder('l')
            ->innerJoin('l.subcategory','s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug)
            ->addSelect('l','s')
            ->orderBy('l.Top', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function filterLinkValue($v_slug, $slug){
//
//        return $this->createQueryBuilder('l')
//            ->innerJoin('l.subcategory','s')
//            ->innerJoin('l.value','v')
//            ->where('s.slug = :v_slug')
//            ->andWhere('v.slug = :slug')
//            ->setParameters(['v_slug' => $v_slug , 'slug' => $slug])
//            ->orderBy('l.name', 'ASC')
//            ->getQuery()
//            ->getResult()
//            ;
//    }

    // /**
    //  * @return Link[] Returns an array of Link objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Link
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
