<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     */
    private ?string $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("DateTime")
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="project")
     */
    private Collection $pictures;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $pathHome = '';
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("DateTime")
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Vich\UploadableField(mapping="projet_file", fileNameProperty="pathHome")
     * @var File|null
     * @Assert\File(
     *     maxSize="1000000",
     *     mimeTypes = {"image/png", "image/jpeg", "image/jpg", "image/gif", "image/webp"})
     */
    private ?File $projetFile = null;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $descriptionHome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $view;


    public function setProjetFile(?File $image = null): Project
    {
        $this->projetFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getProjetFile(): ?File
    {
        return $this->projetFile;
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

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProject($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProject() === $this) {
                $picture->setProject(null);
            }
        }

        return $this;
    }

    public function getPathHome(): ?string
    {
        return $this->pathHome;
    }

    public function setPathHome(?string $pathHome): self
    {
        $this->pathHome = $pathHome;

        return $this;
    }

    public function getDescriptionHome(): ?string
    {
        return $this->descriptionHome;
    }

    public function setDescriptionHome(?string $descriptionHome): self
    {
        $this->descriptionHome = $descriptionHome;

        return $this;
    }

    public function getView(): ?string
    {
        return $this->view;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }
}
