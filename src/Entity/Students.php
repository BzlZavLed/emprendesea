<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentsRepository")
 */
class Students
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $matricula;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $link;

    /**
     * @ORM\Column(type="integer")
     */
    private $facultad;

    /**
     * @ORM\Column(type="integer")
     */
    private $verano;

    /**
     * @ORM\Column(type="integer")
     */
    private $invierno;

    /**
     * @ORM\Column(type="integer")
     */
    private $inter;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $inv_u;

    /**
     * @ORM\Column(type="integer")
     */
    private $int_u;

    /**
     * @ORM\Column(type="integer")
     */
    private $ver_u;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getFacultad(): ?int
    {
        return $this->facultad;
    }

    public function setFacultad(int $facultad): self
    {
        $this->facultad = $facultad;

        return $this;
    }

    public function getVerano(): ?int
    {
        return $this->verano;
    }

    public function setVerano(int $verano): self
    {
        $this->verano = $verano;

        return $this;
    }

    public function getInvierno(): ?int
    {
        return $this->invierno;
    }

    public function setInvierno(int $invierno): self
    {
        $this->invierno = $invierno;

        return $this;
    }

    public function getInter(): ?int
    {
        return $this->inter;
    }

    public function setInter(int $inter): self
    {
        $this->inter = $inter;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getInvU(): ?int
    {
        return $this->inv_u;
    }

    public function setInvU(int $inv_u): self
    {
        $this->inv_u = $inv_u;

        return $this;
    }

    public function getIntU(): ?int
    {
        return $this->int_u;
    }

    public function setIntU(int $int_u): self
    {
        $this->int_u = $int_u;

        return $this;
    }

    public function getVerU(): ?int
    {
        return $this->ver_u;
    }

    public function setVerU(int $ver_u): self
    {
        $this->ver_u = $ver_u;

        return $this;
    }
}
