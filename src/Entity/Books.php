<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     *
     */
    private $imagenes;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $editorial;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $disponibles;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="decimal", precision=60, scale=2)
     */
    private $colportor;

    /**
     * @ORM\Column(type="decimal", precision=60, scale=2)
     */
    private $publico;

    /**
     * @ORM\Column(type="float")
     */
    private $peso;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorias;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $portada;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagenes(): ?array
    {
        return $this->imagenes;
    }

    public function setImagenes($imagenes): self
    {
        $this->imagenes = $imagenes;

        return $this;
    }
    public function addImagen($imagen){
        $this->imagenes[] = $imagen;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

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

    public function getDisponibles(): ?int
    {
        return $this->disponibles;
    }

    public function setDisponibles(int $disponibles): self
    {
        $this->disponibles = $disponibles;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getColportor()
    {
        return $this->colportor;
    }

    public function setColportor($colportor): self
    {
        $this->colportor = $colportor;

        return $this;
    }

    public function getPublico()
    {
        return $this->publico;
    }

    public function setPublico($publico): self
    {
        $this->publico = $publico;

        return $this;
    }


    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }


    public function getCategorias(): ?int
    {
        return $this->categorias;
    }

    public function setCategorias(int $categorias): self
    {
        $this->categorias = $categorias;

        return $this;
    }

    public function getPortada()
    {
        return $this->portada;
    }

    public function setPortada($portada)
    {
        $this->portada = $portada;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }
}
