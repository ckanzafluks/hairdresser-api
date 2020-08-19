<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsAuthorStatus", mappedBy="status")
     */
    private $contractsAuthorStatuses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsReceiverStatus", mappedBy="status")
     */
    private $contractsReceiverStatuses;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsReceiver", mappedBy="status")
     */
    private $contractsReceivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsAuthor", mappedBy="status")
     */
    private $contractsAuthors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Presession", mappedBy="status")
     */
    private $presessions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="statusId")
     */
    private $sessions;

    const STATUS_ACTIF   = 1;
    const STATUS_INACTIF = 0;
    const STATUS_ATTENTE_VALIDATION = 10;
    const STATUS_VALIDE = 4;
    const STATUS_ANNULE = 5;
    const STATUS_ATTENTE_PAIEMENT_MENTORE = 6;
    const STATUS_PAIEMENT_REFUSE = 7;
    const STATUS_PAIEMENT_EN_ATTENTE_ACCEPTATION = 8;
    const STATUS_PAIEMENT_VALIDE = 9;
    const STATUS_SESSION_TERMINEE = 11;
    const STATUS_DEMANDE_ANNULATION = 12;
    const STATUS_DEMANDE_ANNULATION_REFUSEE = 13;
    const STATUS_DEMANDE_ANNULATION_ACCEPTEE = 14;
    const STATUS_VALIDATION_REFUSEE = 15;


    public function __construct()
    {
        $this->contractsAuthorStatuses = new ArrayCollection();
        $this->contractsReceiverStatuses = new ArrayCollection();
        $this->contractsReceivers = new ArrayCollection();
        $this->contractsAuthors = new ArrayCollection();
        $this->presessions = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|ContractsAuthorStatus[]
     */
    public function getContractsAuthorStatuses(): Collection
    {
        return $this->contractsAuthorStatuses;
    }

    public function addContractsAuthorStatus(ContractsAuthorStatus $contractsAuthorStatus): self
    {
        if (!$this->contractsAuthorStatuses->contains($contractsAuthorStatus)) {
            $this->contractsAuthorStatuses[] = $contractsAuthorStatus;
            $contractsAuthorStatus->setStatus($this);
        }

        return $this;
    }

    public function removeContractsAuthorStatus(ContractsAuthorStatus $contractsAuthorStatus): self
    {
        if ($this->contractsAuthorStatuses->contains($contractsAuthorStatus)) {
            $this->contractsAuthorStatuses->removeElement($contractsAuthorStatus);
            // set the owning side to null (unless already changed)
            if ($contractsAuthorStatus->getStatus() === $this) {
                $contractsAuthorStatus->setStatus(null);
            }
        }

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
            $contractsReceiverStatus->setStatus($this);
        }

        return $this;
    }

    public function removeContractsReceiverStatus(ContractsReceiverStatus $contractsReceiverStatus): self
    {
        if ($this->contractsReceiverStatuses->contains($contractsReceiverStatus)) {
            $this->contractsReceiverStatuses->removeElement($contractsReceiverStatus);
            // set the owning side to null (unless already changed)
            if ($contractsReceiverStatus->getStatus() === $this) {
                $contractsReceiverStatus->setStatus(null);
            }
        }

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|ContractsReceiver[]
     */
    public function getContractsReceivers(): Collection
    {
        return $this->contractsReceivers;
    }

    public function addContractsReceiver(ContractsReceiver $contractsReceiver): self
    {
        if (!$this->contractsReceivers->contains($contractsReceiver)) {
            $this->contractsReceivers[] = $contractsReceiver;
            $contractsReceiver->setStatus($this);
        }

        return $this;
    }

    public function removeContractsReceiver(ContractsReceiver $contractsReceiver): self
    {
        if ($this->contractsReceivers->contains($contractsReceiver)) {
            $this->contractsReceivers->removeElement($contractsReceiver);
            // set the owning side to null (unless already changed)
            if ($contractsReceiver->getStatus() === $this) {
                $contractsReceiver->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContractsAuthor[]
     */
    public function getContractsAuthors(): Collection
    {
        return $this->contractsAuthors;
    }

    public function addContractsAuthor(ContractsAuthor $contractsAuthor): self
    {
        if (!$this->contractsAuthors->contains($contractsAuthor)) {
            $this->contractsAuthors[] = $contractsAuthor;
            $contractsAuthor->setStatus($this);
        }

        return $this;
    }

    public function removeContractsAuthor(ContractsAuthor $contractsAuthor): self
    {
        if ($this->contractsAuthors->contains($contractsAuthor)) {
            $this->contractsAuthors->removeElement($contractsAuthor);
            // set the owning side to null (unless already changed)
            if ($contractsAuthor->getStatus() === $this) {
                $contractsAuthor->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Presession[]
     */
    public function getPresessions(): Collection
    {
        return $this->presessions;
    }

    public function addPresession(Presession $presession): self
    {
        if (!$this->presessions->contains($presession)) {
            $this->presessions[] = $presession;
            $presession->setStatus($this);
        }

        return $this;
    }

    public function removePresession(Presession $presession): self
    {
        if ($this->presessions->contains($presession)) {
            $this->presessions->removeElement($presession);
            // set the owning side to null (unless already changed)
            if ($presession->getStatus() === $this) {
                $presession->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setStatusId($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getStatusId() === $this) {
                $session->setStatusId(null);
            }
        }

        return $this;
    }
}
