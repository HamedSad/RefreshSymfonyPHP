<?php

namespace App\Repository\Product;

use App\Entity\Product\Shower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shower[]    findAll()
 * @method Shower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shower::class);
    }

    /**
    *@return array
    *
    */
    public function findAllVisibleShower():array{
        return $this->createQueryBuilder('p')
            ->orderBy('p.showerPrice', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Shower[] Returns an array of Shower objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shower
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
