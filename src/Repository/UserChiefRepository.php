<?php

namespace App\Repository;

use App\Entity\UserChief;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserChief|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserChief|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserChief[]    findAll()
 * @method UserChief[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserChiefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChief::class);
    }

    // /**
    //  * @return UserChief[] Returns an array of UserChief objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserChief
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
