<?php

namespace App\Repository;

use App\Entity\BookCath;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookCath|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookCath|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookCath[]    findAll()
 * @method BookCath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookCathRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookCath::class);
    }

//    /**
//     * @return BookCath[] Returns an array of BookCath objects
//     */
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
    public function findOneBySomeField($value): ?BookCath
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
