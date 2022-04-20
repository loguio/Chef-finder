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

    public function findAllOrderedBy($orderKey): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.' . $orderKey, 'ASC')
            ->getQuery()
            ->getResult();
    }

}
