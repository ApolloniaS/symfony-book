<?php

namespace App\Entity;

use App\Repository\UserBookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserBookRepository::class)
 */
class UserBook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $readingStatus;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBook;

    public function __construct()
    {
        $this->idBook = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReadingStatus(): ?string
    {
        return $this->readingStatus;
    }

    public function setReadingStatus(string $readingStatus): self
    {
        $this->readingStatus = $readingStatus;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdBook(): ?Book
    {
        return $this->idBook;
    }

    public function setIdBook(?Book $idBook): self
    {
        $this->idBook = $idBook;

        return $this;
    }

   
}
