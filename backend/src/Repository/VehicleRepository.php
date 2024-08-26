<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    public function findByFilters(array $filters, string|null $sort, string $order, int $page, int $limit):Paginator
    {
        $queryBuilder = $this->createQueryBuilder('v');

        if (!empty($filters['brand'])) {
            $queryBuilder->andWhere('v.brand = :brand')
                ->setParameter('brand', $filters['brand']);
        }

        if (!empty($filters['model'])) {
            $queryBuilder->andWhere('v.model = :model')
                ->setParameter('model', $filters['model']);
        }

        if (!empty($filters['energy'])) {
            $queryBuilder->andWhere('v.energy = :energy')
                ->setParameter('energy', $filters['energy']);
        }

        if (!empty($filters['minPrice'])) {
            $queryBuilder->andWhere('v.price >= :minPrice')
                ->setParameter('minPrice', $filters['minPrice']);
        }

        if (!empty($filters['maxPrice'])) {
            $queryBuilder->andWhere('v.price <= :maxPrice')
                ->setParameter('maxPrice', $filters['maxPrice']);
        }
        if ($sort) {
            $queryBuilder->orderBy('v.' . $sort, $order);
        }

        $queryBuilder->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($queryBuilder);
    }

    //    /**
    //     * @return Vehicle[] Returns an array of Vehicle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vehicle
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
