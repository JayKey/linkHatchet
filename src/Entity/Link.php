<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $shortLink;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longLink;

    /**
     * @ORM\OneToMany(targetEntity=MetaAccess::class, mappedBy="link", orphanRemoval=true)
     */
    private $metaAccesses;

    /**
     * @ORM\OneToOne(targetEntity=MetaCreate::class, mappedBy="link", cascade={"persist", "remove"})
     */
    private $metaCreate;

    public function __construct()
    {
        $this->metaAccesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortLink(): ?string
    {
        return $this->shortLink;
    }

    public function setShortLink(string $shortLink): self
    {
        $this->shortLink = $shortLink;

        return $this;
    }

    public function getLongLink(): ?string
    {
        return $this->longLink;
    }

    public function setLongLink(string $longLink): self
    {
        $this->longLink = $longLink;

        return $this;
    }

    /**
     * @return Collection|MetaAccess[]
     */
    public function getMetaAccesses(): Collection
    {
        return $this->metaAccesses;
    }

    public function addMetaAccess(MetaAccess $metaAccess): self
    {
        if (!$this->metaAccesses->contains($metaAccess)) {
            $this->metaAccesses[] = $metaAccess;
            $metaAccess->setLink($this);
        }

        return $this;
    }

    public function removeMetaAccess(MetaAccess $metaAccess): self
    {
        if ($this->metaAccesses->removeElement($metaAccess)) {
            // set the owning side to null (unless already changed)
            if ($metaAccess->getLink() === $this) {
                $metaAccess->setLink(null);
            }
        }

        return $this;
    }

    public function getMetaCreate(): ?MetaCreate
    {
        return $this->metaCreate;
    }

    public function setMetaCreate(MetaCreate $metaCreate): self
    {
        // set the owning side of the relation if necessary
        if ($metaCreate->getLink() !== $this) {
            $metaCreate->setLink($this);
        }

        $this->metaCreate = $metaCreate;

        return $this;
    }
}
