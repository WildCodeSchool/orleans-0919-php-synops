<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 * @UniqueEntity("name", message="Ce nom de partenaire est dejà utilisé")
 */
class Partner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Ce lien ne peut pas faire plus de {{ limit }} caractères."
     * )
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Ce lien ne peut pas faire plus de {{ limit }} caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Ce nom ne peut pas faire plus de {{ limit }} caractères."
     * )
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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
}
