<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemporadasRepository")
 */
class Temporadas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInicial;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaFinal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicial(): ?\DateTimeInterface
    {
        return $this->fechaInicial;
    }

    public function setFechaInicial(\DateTimeInterface $fechaInicial): self
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    public function getFechaFinal(): ?\DateTimeInterface
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal(\DateTimeInterface $fechaFinal): self
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }
}
