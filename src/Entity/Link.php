<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Top;

    /**
     * @ORM\ManyToOne(targetEntity=Subcategory::class, inversedBy="link")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subcategory;

    /**
     * @ORM\ManyToMany(targetEntity=Value::class, inversedBy="links")
     */
    private $value;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->value = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getStatue(): ?bool
    {
        return $this->statue;
    }

    public function setStatue(bool $statue): self
    {
        $this->statue = $statue;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->Top;
    }

    public function setTop(bool $Top): self
    {
        $this->Top = $Top;

        return $this;
    }

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): self
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * @return Collection|Value[]
     */
    public function getValue(): Collection
    {
        return $this->value;
    }

    public function addValue(Value $value): self
    {
        if (!$this->value->contains($value)) {
            $this->value[] = $value;
        }

        return $this;
    }

    public function removeValue(Value $value): self
    {
        $this->value->removeElement($value);

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
