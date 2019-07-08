<?php

namespace App\Repository\Product;

use App\Entity\Product\Paint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Paint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paint[]    findAll()
 * @method Paint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Paint::class);
    }

    /**
    *@return array
    *
    */
    public function findAllVisiblePaint():array{
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Paint[] Returns an array of Paint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paint
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
