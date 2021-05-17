<?php

namespace App\Entity;

use App\Repository\AudienceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=AudienceRepository::class)
 */
class Audience
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
     * @ORM\Column(type="string", length=50)
     */
    private $audienceGroup;

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
