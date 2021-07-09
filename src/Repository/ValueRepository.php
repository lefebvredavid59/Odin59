<?php

namespace App\Repository;

use App\Entity\Value;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Value|null find($id, $lockMode = null, $lockVersion = null)
 * @method Value|null findOneBy(array $criteria, array $orderBy = null)
 * @method Value[]    findAll()
 * @method Value[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Value::class);
    }

    public function filterValueAll($slug){

        return $this->createQueryBuilder('v')
            ->innerJoin('v.links','l')
            ->innerJoin('l.subcategory','s')
            ->where('s.slug = :slug')
            ->setParameter('slug',$slug)
            ->andWhere('v.links is not empty')
            ->orderBy('v.name', 'ASC')
            ->addSelect('l','s')
            ->getQuery()
            ->getResult()
            ;
    }

    public function filterValue($c_slug){

        return $this->createQueryBuilder('v')
            ->innerJoin('v.links','l')
            ->innerJoin('l.subcategory','s')
            ->where('s.slug = :slug')
            ->setParameter('slug',$c_slug)
            ->andWhere('v.links is not empty')
            ->orderBy('v.name', 'ASC')
            ->addSelect('l','s')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Value[] Returns an array of Value objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Value
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
