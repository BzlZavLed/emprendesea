<?php

namespace App\Repository;

use App\Entity\Campos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Campos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campos[]    findAll()
 * @method Campos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamposRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Campos::class);
    }

//    /**
//     * @return Campos[] Returns an array of Campos objects
//     */
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
    public function findOneBySomeField($value): ?Campos
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
