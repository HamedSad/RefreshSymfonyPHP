<?php

namespace App\Repository\Product;

use App\Entity\Product\Bathtub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bathtub|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bathtub|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bathtub[]    findAll()
 * @method Bathtub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BathtubRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bathtub::class);
    }

    /**
    *@return array
    *
    */
    public function findAllVisibleBathtub():array{
        return $this->createQueryBuilder('p')
            ->orderBy('p.bathtubPrice', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Bathtub[] Returns an array of Bathtub objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bathtub
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
