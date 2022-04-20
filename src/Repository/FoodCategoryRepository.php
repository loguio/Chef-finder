<?php

namespace App\Repository;

use App\Entity\FoodCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FoodCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodCategory[]    findAll()
 * @method FoodCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodCategory::class);
    }

    public function findAllOrderedBy($orderKey): array
    {
        return $this->createQueryBuilder('fc')
            ->orderBy('fc.' . $orderKey, 'ASC')
            ->getQuery()
            ->getResult();
    }

}
