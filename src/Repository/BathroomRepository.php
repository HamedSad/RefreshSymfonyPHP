<?php

namespace App\Repository;

use App\Entity\Bathroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bathroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bathroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bathroom[]    findAll()
 * @method Bathroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BathroomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bathroom::class);
    }

    /**
    *@return array
    *
    */
    public function findAllVisible():array{
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Bathroom[] Returns an array of Bathroom objects
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
    public function findOneBySomeField($value): ?Bathroom
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
