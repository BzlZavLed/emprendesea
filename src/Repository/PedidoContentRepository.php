<?php

namespace App\Repository;

use App\Entity\PedidoContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PedidoContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PedidoContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PedidoContent[]    findAll()
 * @method PedidoContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PedidoContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PedidoContent::class);
    }
//    /**
//     * @return PedidoContent[] Returns an array of PedidoContent objects
//     */
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
    public function findOneBySomeField($value): ?PedidoContent
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
