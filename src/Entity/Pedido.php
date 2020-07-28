<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $last;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $entre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $state;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ship_id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $tracking;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $carrier;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $payment_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $request_date;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $student_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $campo_id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $delivery_service;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $delivery_price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total_lista;

      /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $std_name;

      /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $std_place;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $std_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLast(): ?string
    {
        return $this->last;
    }

    public function setLast(string $last): self
    {
        $this->last = $last;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getEntre(): ?string
    {
        return $this->entre;
    }

    public function setEntre(?string $entre): self
    {
        $this->entre = $entre;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getShipId(): ?int
    {
        return $this->ship_id; 
    }

    public function setShipId(?int $ship_id): self
    {
        $this->ship_id = $ship_id;

        return $this;
    }

    public function getTracking(): ?string
    {
        return $this->tracking;
    }

    public function setTracking(?string $tracking): self
    {
        $this->tracking = $tracking;

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

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function setPaymentId(?string $payment_id): self
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->request_date;
    }

    public function setRequestDate(\DateTimeInterface $request_date): self
    {
        $this->request_date = $request_date;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStudentId(): ?int
    {
        return $this->student_id;
    }

    public function setStudentId(int $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getCampoId(): ?int
    {
        return $this->campo_id;
    }

    public function setCampoId(int $campo_id): self
    {
        $this->campo_id = $campo_id;

        return $this;
    }

    public function getDeliveryService(): ?string
    {
        return $this->delivery_service;
    }

    public function setDeliveryService(?string $delivery_service): self
    {
        $this->delivery_service = $delivery_service;

        return $this;
    }

    public function getDeliveryPrice(): ?float
    {
        return $this->delivery_price;
    }

    public function setDeliveryPrice(?float $delivery_price): self
    {
        $this->delivery_price = $delivery_price;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTotalLista(): ?float
    {
        return $this->total_lista;
    }

    public function setTotalLista(?float $total_lista): self
    {
        $this->total_lista = $total_lista;

        return $this;
    }

    public function getStdName(): ?string
    {
        return $this->std_name;
    }

    public function setStdName(?string $std_name): self
    {
        $this->std_name = $std_name;

        return $this;
    }

    public function getStdPlace(): ?string
    {
        return $this->std_place;
    }

    public function setStdPlace(?string $std_place): self
    {
        $this->std_place = $std_place;

        return $this;
    }

    public function getStdDate(): ?string
    {
        return $this->std_date;
    }

    public function setStdDate(?string $std_date): self
    {
        $this->std_date = $std_date;

        return $this;
    }
}
