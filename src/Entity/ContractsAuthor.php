<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractsAuthorRepository")
 */
class ContractsAuthor
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
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $contracted;

    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="contracts")
     */
    private $sessions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="contracts")
     */
    private $objectif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="contracts")
     */
    private $experience;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contractsAuthor")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContractsReceiver", mappedBy="contractsAuthor", cascade={"persist", "remove"})
     */
    private $contractsReceiver;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsAuthorStatus", mappedBy="contractsAuthor")
     */
    private $contractsAuthorStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="contractsAuthors")
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $intermediateGoal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsMessages", mappedBy="contractsAuthor")
     */
    private $contractsMessages;


    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->contractsAuthorStatus = new ArrayCollection();
        $this->contractsMessages = new ArrayCollection();
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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
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

    public function getContracted(): ?\DateTimeInterface
    {
        return $this->contracted;
    }

    public function setContracted(?\DateTimeInterface $contracted): self
    {
        $this->contracted = $contracted;

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
            $session->setContracts($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getContracts() === $this) {
                $session->setContracts(null);
            }
        }

        return $this;
    }

    public function getObjectif(): ?Ads
    {
        return $this->objectif;
    }

    public function setObjectif(?Ads $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getExperience(): ?Ads
    {
        return $this->experience;
    }

    public function setExperience(?Ads $experience): self
    {
        $this->experience = $experience;

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

    public function getContractsReceiver(): ?ContractsReceiver
    {
        return $this->contractsReceiver;
    }

    public function setContractsReceiver(?ContractsReceiver $contractsReceiver): self
    {
        $this->contractsReceiver = $contractsReceiver;

        // set (or unset) the owning side of the relation if necessary
        $newContractsAuthor = null === $contractsReceiver ? null : $this;
        if ($contractsReceiver->getContractsAuthor() !== $newContractsAuthor) {
            $contractsReceiver->setContractsAuthor($newContractsAuthor);
        }

        return $this;
    }

    /**
     * @return Collection|ContractsAuthorStatus[]
     */
    public function getContractsAuthorStatus(): Collection
    {
        return $this->contractsAuthorStatus;
    }

    public function addContractsAuthorStatus(ContractsAuthorStatus $contractsAuthorStatus): self
    {
        if (!$this->contractsAuthorStatus->contains($contractsAuthorStatus)) {
            $this->contractsAuthorStatus[] = $contractsAuthorStatus;
            $contractsAuthorStatus->setContractsAuthor($this);
        }

        return $this;
    }

    public function removeContractsAuthorStatus(ContractsAuthorStatus $contractsAuthorStatus): self
    {
        if ($this->contractsAuthorStatus->contains($contractsAuthorStatus)) {
            $this->contractsAuthorStatus->removeElement($contractsAuthorStatus);
            // set the owning side to null (unless already changed)
            if ($contractsAuthorStatus->getContractsAuthor() === $this) {
                $contractsAuthorStatus->setContractsAuthor(null);
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

    public function getIntermediateGoal(): ?string
    {
        return $this->intermediateGoal;
    }

    public function setIntermediateGoal(?string $intermediateGoal): self
    {
        $this->intermediateGoal = $intermediateGoal;

        return $this;
    }

    /**
     * @return Collection|ContractsMessages[]
     */
    public function getContractsMessages(): Collection
    {
        return $this->contractsMessages;
    }

    public function addContractsMessage(ContractsMessages $contractsMessage): self
    {
        if (!$this->contractsMessages->contains($contractsMessage)) {
            $this->contractsMessages[] = $contractsMessage;
            $contractsMessage->setContractsAuthor($this);
        }

        return $this;
    }

    public function removeContractsMessage(ContractsMessages $contractsMessage): self
    {
        if ($this->contractsMessages->contains($contractsMessage)) {
            $this->contractsMessages->removeElement($contractsMessage);
            // set the owning side to null (unless already changed)
            if ($contractsMessage->getContractsAuthor() === $this) {
                $contractsMessage->setContractsAuthor(null);
            }
        }

        return $this;
    }

}
