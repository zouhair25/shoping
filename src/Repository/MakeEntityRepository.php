<?php

namespace App\Repository;

use App\Entity\MakeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MakeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeEntity[]    findAll()
 * @method MakeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeEntity::class);
    }

    // /**
    //  * @return MakeEntity[] Returns an array of MakeEntity objects
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
    public function findOneBySomeField($value): ?MakeEntity
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
