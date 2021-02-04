<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 * @Vich\Uploadable
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $prestation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $picture = '';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("DateTime")
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Vich\UploadableField(mapping="picture_file", fileNameProperty="picture")
     * @var File|null
     * @Assert\File(
     *     maxSize="1000000",
     *     mimeTypes = {"image/png", "image/jpeg", "image/jpg", "image/gif", "image/webp"})
     */
    private ?File $pictureFile = null;

    public function setPictureFile(?File $image = null): Prestation
    {
        $this->pictureFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(string $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
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
}
