<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 *  @UniqueEntity("description")
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre nom {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tool", inversedBy="documents")
     * @Assert\NotBlank(message="Veuillez sélectionner un champ")
     */
    private $tool;


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
}
