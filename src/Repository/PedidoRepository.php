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
    public function getConcentrado(): array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT e.id,concat(e.name," ",e.last)as name, e.request_date, e.payment_id,e.carrier,e.tracking,e.delivery_service,e.delivery_price,e.total,e.email,concat(f.name," ",f.apellidos) as student, g.name as colegio FROM pedido e INNER JOIN students f ON e.student_id = f.id INNER JOIN campos g ON e.campo_id = g.id ORDER BY id DESC';
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
