<?php

namespace App\Entity;

use App\Repository\LinkRepository;
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
}
