<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * @UniqueEntity("description")
 * @Vich\Uploadable
 */
class Document
{
    const MIMETYPE = [
        'application/pdf' => 'fas fa-file-pdf',
        'application/msword' => 'fas fa-file-word',
        'application/vnd.ms-powerpoint'=> 'fas fa-file-powerpoint',
        'application/vnd.ms-excel'=>'fas fa-file-excel',
        'application/msexcel'=>'fas fa-file-excel',
        'application/x-msexcel'=>'fas fa-file-excel',
        'application/x-ms-excel'=>'fas fa-file-excel',
        'application/x-excel'=>'fas fa-file-excel',
        'application/xls'=>'fas fa-file-excel',
        'application/x-xls'=>'fas fa-file-excel',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12'=>'fas fa-file-powerpoint',
        'default'=>"fas fa-file-alt"
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tool", inversedBy="documents")
     * @Assert\NotBlank(message="Veuillez sélectionner un champ")
     */
    private $tool;

    /**
     * @Vich\UploadableField(mapping="document_file", fileNameProperty="fileName", mimeType="mimeTypeFile")
     * @Assert\File(
     *     maxSize="2M",
     * )
     * @var File|null
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $fileName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mimeTypeFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTool(): ?Tool
    {
        return $this->tool;
    }

    public function setTool(?Tool $tool): self
    {
        $this->tool = $tool;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param File|null $file
     * @return Document
     * @throws \Exception
     */
    public function setFile(?File $file): Document
    {
        $this->file = $file;

        if ($this->file instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param string|null $fileName
     * @return Document
     */
    public function setFileName(?string $fileName): Document
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
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

    public function getMimeTypeFile(): string
    {
        return $this->mimeTypeFile;
    }

    public function setMimeTypeFile(?string $mimeTypeFile): self
    {
        $this->mimeTypeFile = $mimeTypeFile;

        return $this;
    }

    public function getMimeIcon(): ?string
    {
        if (array_key_exists($this->getMimeTypeFile(), self::MIMETYPE)) {
            return self::MIMETYPE[$this->getMimeTypeFile()];
        } else {
            return self::MIMETYPE['default'];
        }
    }
}
