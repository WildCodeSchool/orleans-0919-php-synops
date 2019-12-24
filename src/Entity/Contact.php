<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre prénom {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $firstname;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre nom {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $lastname;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     * @Assert\Email()
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre email {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $email;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Le nom de votre entreprise {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $enterprise;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre activité {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $activity;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner ces informations")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEnterprise(): ?string
    {
        return $this->enterprise;
    }

    public function setEnterprise(?string $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
