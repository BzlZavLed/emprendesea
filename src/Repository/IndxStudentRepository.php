<?php

namespace App\Repository;

use App\Entity\IndxStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IndxStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndxStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndxStudent[]    findAll()
 * @method IndxStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndxStudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IndxStudent::class);
    }

//    /**
//     * @return IndxStudent[] Returns an array of IndxStudent objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndxStudent
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
