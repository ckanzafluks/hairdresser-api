<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserFileIdentityRepository")
 */
class UserFileIdentity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userFileIdentities")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf", "image/jpeg","image/png"},
     *     mimeTypesMessage = "Le document envoyé ne semble pas valide"
     * )
     */
    private $pathFile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateValidation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $messageValidation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="userFileIdentities")
     */
    private $ads;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPathFile(): ?string
    {
        return $this->pathFile;
    }

    public function setPathFile(string $pathFile): self
    {
        $this->pathFile = $pathFile;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->dateValidation;
    }

    public function setDateValidation(?\DateTimeInterface $dateValidation): self
    {
        $this->dateValidation = $dateValidation;

        return $this;
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

    public function getMessageValidation(): ?string
    {
        return $this->messageValidation;
    }

    public function setMessageValidation(?string $messageValidation): self
    {
        $this->messageValidation = $messageValidation;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAds(): ?Ads
    {
        return $this->ads;
    }

    public function setAds(?Ads $ads): self
    {
        $this->ads = $ads;

        return $this;
    }
}
