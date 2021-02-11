<?php

namespace App\Repository;

use App\Entity\MetaAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaAccess[]    findAll()
 * @method MetaAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaAccess::class);
    }

    // /**
    //  * @return MetaAccess[] Returns an array of MetaAccess objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetaAccess
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
