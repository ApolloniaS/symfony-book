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
     * @ORM\ManyToOne(targetEntity=Audience::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $idAudience;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $firstRelease;

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

    public function getIdAudience(): ?Audience
    {
        return $this->idAudience;
    }

    public function setIdAudience(?Audience $idAudience): self
    {
        $this->idAudience = $idAudience;

        return $this;
    }

    public function getFirstRelease(): ?\DateTimeInterface
    {
        return $this->firstRelease;
    }

    public function setFirstRelease(?\DateTimeInterface $firstRelease): self
    {
        $this->firstRelease = $firstRelease;

        return $this;
    }

}
