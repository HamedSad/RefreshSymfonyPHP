<?php

namespace App\Repository\Product;

use App\Entity\Product\Toilets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Toilets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toilets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toilets[]    findAll()
 * @method Toilets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToiletsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Toilets::class);
    }

    /**
    *@return array
    *
    */
    public function findAllVisibleToilets():array{
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Toilets[] Returns an array of Toilets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Toilets
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
