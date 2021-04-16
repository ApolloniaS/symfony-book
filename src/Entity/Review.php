<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $reviewDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reviewContent;

    /**
     * @ORM\Column(type="float")
     */
    private $reviewScore;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewDate(): ?\DateTimeInterface
    {
        return $this->reviewDate;
    }

    public function setReviewDate(\DateTimeInterface $reviewDate): self
    {
        $this->reviewDate = $reviewDate;

        return $this;
    }

    public function getReviewContent(): ?string
    {
        return $this->reviewContent;
    }

    public function setReviewContent(string $reviewContent): self
    {
        $this->reviewContent = $reviewContent;

        return $this;
    }

    public function getReviewScore(): ?float
    {
        return $this->reviewScore;
    }

    public function setReviewScore(float $reviewScore): self
    {
        $this->reviewScore = $reviewScore;

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
