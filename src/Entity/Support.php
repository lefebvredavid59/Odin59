<?php

namespace App\Entity;

use App\Repository\SupportRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SupportRepository::class)
 */
class Support
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Value::class, inversedBy="supports")
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?Value
    {
        return $this->value;
    }

    public function setValue(?Value $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
