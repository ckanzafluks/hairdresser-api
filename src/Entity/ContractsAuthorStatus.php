<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractsAuthorStatusRepository")
 */
class ContractsAuthorStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="contractsAuthorStatus")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractsAuthor", inversedBy="contractsAuthorStatus")
     */
    private $contractsAuthor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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
