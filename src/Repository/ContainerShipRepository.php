<?php

namespace App\Repository;

use App\Entity\ContainerShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContainerShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContainerShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContainerShip[]    findAll()
 * @method ContainerShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainerShipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContainerShip::class);
    }

    // /**
    //  * @return ContainerShip[] Returns an array of ContainerShip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContainerShip
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
