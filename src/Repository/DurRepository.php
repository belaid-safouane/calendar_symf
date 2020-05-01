<?php

namespace App\Repository;

use App\Entity\Dur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Dur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dur[]    findAll()
 * @method Dur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dur::class);
    }

    // /**
    //  * @return Dur[] Returns an array of Dur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
