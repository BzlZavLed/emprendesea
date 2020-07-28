<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoContentRepository")
 */
class PedidoContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pedido_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $book_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qtt;

    /**
     * @ORM\Column(type="float")
     */
    private $unit_price;
    
    /**
     * @ORM\Column(type="float")
     */
    private $unit_price_list;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPedidoId(): ?int
    {
        return $this->pedido_id;
    }

    public function setPedidoId(int $pedido_id): self
    {
        $this->pedido_id = $pedido_id;

        return $this;
    }

    public function getBookId(): ?int
    {
        return $this->book_id;
    }

    public function setBookId(int $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getQtt(): ?int
    {
        return $this->qtt;
    }

    public function setQtt(int $qtt): self
    {
        $this->qtt = $qtt;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unit_price;
    }

    public function setUnitPrice(float $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getUnitPriceList(): ?float
    {
        return $this->unit_price_list;
    }

    public function setUnitPriceList(float $unit_price_list): self
    {
        $this->unit_price_list = $unit_price_list;

        return $this;
    }
}
