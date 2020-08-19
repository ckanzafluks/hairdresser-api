<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractsMessagesRepository")
 */
class ContractsMessages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contractsMessages")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contractsMessages")
     */
    private $receiver;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $openDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="contractsMessages")
     */
    private $ads;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractsAuthor", inversedBy="contractsMessages")
     */
    private $contractsAuthor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

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

    public function getOpenDate(): ?\DateTimeInterface
    {
        return $this->openDate;
    }

    public function setOpenDate(?\DateTimeInterface $openDate): self
    {
        $this->openDate = $openDate;

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

    public function getContractsAuthor(): ?ContractsAuthor
    {
        return $this->contractsAuthor;
    }

    public function setContractsAuthor(?ContractsAuthor $contractsAuthor): self
    {
        $this->contractsAuthor = $contractsAuthor;

        return $this;
    }
}
