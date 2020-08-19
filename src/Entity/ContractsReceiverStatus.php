<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractsReceiverStatusRepository")
 */
class ContractsReceiverStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="contractsReceiverStatuses")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractsReceiver", inversedBy="contractsReceiverStatuses")
     */
    private $contractsReceiver;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getContractsReceiver(): ?ContractsReceiver
    {
        return $this->contractsReceiver;
    }

    public function setContractsReceiver(?ContractsReceiver $contractsReceiver): self
    {
        $this->contractsReceiver = $contractsReceiver;

        return $this;
    }
}
