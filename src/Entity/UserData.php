<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserDataRepository")
 */
class UserData implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50,unique=true)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getRoles(){
        return [
            'ROLE_USER'
        ];
    }

    public function getSalt(){
    }
    public function eraseCredentials(){}

    /** @see \Serializable::serialize() */
    public function serialize(){
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password
            ]);
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($string){
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password
            ) = unserialize($string,['allowed_classes' => false]);
    }
}
