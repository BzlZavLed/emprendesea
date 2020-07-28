<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryRateRepository")
 */
class DeliveryRate
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
     * @ORM\Column(type="string", length=10)
     */
    private $carrier;

    /**
     * @ORM\Column(type="integer")
     */
    private $rate_id;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $service;

    /**
     * @ORM\Column(type="date")
     */
    private $delivery;

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

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function setCarrier(string $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getRateId(): ?int
    {
        return $this->rate_id;
    }

    public function setRateId(int $rate_id): self
    {
        $this->rate_id = $rate_id;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getDelivery(): ?\DateTimeInterface
    {
        return $this->delivery;
    }

    public function setDelivery(\DateTimeInterface $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }
}
