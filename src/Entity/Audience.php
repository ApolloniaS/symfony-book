<?php

namespace App\Entity;

use App\Repository\AudienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AudienceRepository::class)
 */
class Audience
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
    private $audienceGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAudienceGroup(): ?string
    {
        return $this->audienceGroup;
    }

    public function setAudienceGroup(string $audienceGroup): self
    {
        $this->audienceGroup = $audienceGroup;

        return $this;
    }
}
