<?php

namespace App\Repository;

use App\Entity\MetaCreate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaCreate|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaCreate|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaCreate[]    findAll()
 * @method MetaCreate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaCreateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaCreate::class);
    }

    // /**
    //  * @return MetaCreate[] Returns an array of MetaCreate objects
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
    public function findOneBySomeField($value): ?MetaCreate
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
