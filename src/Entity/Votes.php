<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VotesRepository")
 */
class Votes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="votes")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $idAuthor;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $idReceiver;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $rating;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getIdAuthor(): ?User
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(?User $idAuthor): self
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    public function getIdReceiver(): ?int
    {
        return $this->idReceiver;
    }

    public function setIdReceiver(int $idReceiver): self
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
