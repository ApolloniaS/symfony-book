<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;

    /**
     * @ORM\Column(type="date")
     */
    private $firstRelease;

    /**
     * @ORM\ManyToOne(targetEntity=Audience::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAudience;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getFirstRelease(): ?\DateTimeInterface
    {
        return $this->firstRelease;
    }

    public function setFirstRelease(\DateTimeInterface $firstRelease): self
    {
        $this->firstRelease = $firstRelease;

        return $this;
    }

    public function getIdAudience(): ?Audience
    {
        return $this->idAudience;
    }

    public function setIdAudience(?Audience $idAudience): self
    {
        $this->idAudience = $idAudience;

        return $this;
    }

}
