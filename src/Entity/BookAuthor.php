<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\BookAuthorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookAuthorRepository::class)
 */
class BookAuthor
{

    public function hydrate(array $init)
    {
        foreach ($init as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAuthor;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBook;

    public function __construct($arrayInit = [])
    {
        $this->exemplaires = new ArrayCollection();
        // appel au hydrate
        $this->hydrate($arrayInit);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAuthor(): ?Author
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(?Author $idAuthor): self
    {
        $this->idAuthor = $idAuthor;

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
