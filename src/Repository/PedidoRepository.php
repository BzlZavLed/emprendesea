<?php

namespace App\Repository;

use App\Entity\Pedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pedido|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pedido|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pedido[]    findAll()
 * @method Pedido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PedidoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pedido::class);
    }
    public function getSimpleList(): array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT name, last, tracking, id, payment_id FROM pedido ORDER BY id DESC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getByCampo($ini, $fin, $campo): array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT name, last, campo_id, id, total,total_lista, delivery_price FROM pedido WHERE request_date >= '".$ini."' AND request_date <= '".$fin."' AND campo_id = '".$campo."';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getByEstudiante($ini, $fin, $matricula): array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT name, last, campo_id, id, total,total_lista, delivery_price FROM pedido WHERE request_date >= '".$ini."' AND request_date <= '".$fin."' AND student_id = '".$matricula."';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
//    /**
//     * @return Pedido[] Returns an array of Pedido objects
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
    public function findOneBySomeField($value): ?Pedido
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
