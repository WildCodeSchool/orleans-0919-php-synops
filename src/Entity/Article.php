<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *     maxMessage = "Votre titre ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     minMessage = "Votre article doit faire un minimum de {{ limit }} caractères",
     *     )
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 5,
     *     max = 255,
     *     minMessage = "Le nom de votre photo doit faire au moins {{ limit }} caractères",
     *     maxMessage = "Le nom de votre photo doit faire un minimum de {{ limit }} caractères"
     * )
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
