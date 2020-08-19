<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractsReceiverRepository")
 */
class ContractsReceiver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contractAuthor")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContractsAuthor", inversedBy="contractsReceiver", cascade={"persist", "remove"})
     */
    private $contractsAuthor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsReceiverStatus", mappedBy="contractsReceiver")
     */
    private $contractsReceiverStatuses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="contractsReceivers")
     */
    private $status;

    public function __construct()
    {
        $this->contractsReceiverStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    /**
     * @return Collection|ContractsReceiverStatus[]
     */
    public function getContractsReceiverStatuses(): Collection
    {
        return $this->contractsReceiverStatuses;
    }

    public function addContractsReceiverStatus(ContractsReceiverStatus $contractsReceiverStatus): self
    {
        if (!$this->contractsReceiverStatuses->contains($contractsReceiverStatus)) {
            $this->contractsReceiverStatuses[] = $contractsReceiverStatus;
            $contractsReceiverStatus->setContractsReceiver($this);
        }

        return $this;
    }

    public function removeContractsReceiverStatus(ContractsReceiverStatus $contractsReceiverStatus): self
    {
        if ($this->contractsReceiverStatuses->contains($contractsReceiverStatus)) {
            $this->contractsReceiverStatuses->removeElement($contractsReceiverStatus);
            // set the owning side to null (unless already changed)
            if ($contractsReceiverStatus->getContractsReceiver() === $this) {
                $contractsReceiverStatus->setContractsReceiver(null);
            }
        }

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
}
