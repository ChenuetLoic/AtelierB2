<?php

namespace App\Entity;

use App\Repository\PicturesProjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PicturesProjetRepository::class)
 */
class PicturesProjet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pictures;

    /**
     * @ORM\ManyToOne(targetEntity=Projets::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictures(): ?string
    {
        return $this->pictures;
    }

    public function setPictures(?string $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getProjet(): ?Projets
    {
        return $this->projet;
    }

    public function setProjet(?Projets $projet): self
    {
        $this->projet = $projet;

        return $this;
    }
}
