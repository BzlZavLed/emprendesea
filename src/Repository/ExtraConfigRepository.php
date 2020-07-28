<?php

namespace App\Repository;

use App\Entity\ExtraConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExtraConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtraConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtraConfig[]    findAll()
 * @method ExtraConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtraConfigRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExtraConfig::class);
    }

//    /**
//     * @return ExtraConfig[] Returns an array of ExtraConfig objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExtraConfig
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
