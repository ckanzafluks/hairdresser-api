<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresessionRepository")
 */
class Presession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mentor")
     */
    private $mentor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mentore")
     *
     */
    private $mentore;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="presessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="presessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="ojectifPresession")
     */
    private $objectif;

    /**
     * @ORM\Column(type="datetime")
     */
    private $proposalDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="presessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressesionId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenMessage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="presession")
     */
    private $sessions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lastEvents;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $programme;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $intermediateObjective;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $receiver;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $typeOffer;



    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->created = new \DateTime();
        $this->setLastEvents(true);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMentor(): ?User
    {
        return $this->mentor;
    }

    public function setMentor(?User $mentor): self
    {
        $this->mentor = $mentor;


        return $this;
    }

    public function getMentore(): ?User
    {
        return $this->mentore;
    }

    public function setMentore(?User $mentore): self
    {
        $this->mentore = $mentore;

        return $this;
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

    public function getCompetence(): ?Ads
    {
        return $this->competence;
    }

    public function setCompetence(?Ads $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getProposalDate(): ?\DateTimeInterface
    {
        return $this->proposalDate;
    }

    public function setProposalDate(\DateTimeInterface $proposalDate): self
    {
        $this->proposalDate = $proposalDate;

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getPressesionId(): ?int
    {
        return $this->pressesionId;
    }

    public function setPressesionId(int $pressesionId): self
    {
        $this->pressesionId = $pressesionId;

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

    public function getTokenMessage(): ?string
    {
        return $this->tokenMessage;
    }

    public function setTokenMessage(?string $tokenMessage): self
    {
        $this->tokenMessage = $tokenMessage;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

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
            $session->setPresession($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getPresession() === $this) {
                $session->setPresession(null);
            }
        }

        return $this;
    }

    public function getLastEvents(): ?bool
    {
        return $this->lastEvents;
    }

    public function setLastEvents(bool $lastEvents): self
    {
        $this->lastEvents = $lastEvents;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(?string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getIntermediateObjective(): ?string
    {
        return $this->intermediateObjective;
    }

    public function setIntermediateObjective(?string $intermediateObjective): self
    {
        $this->intermediateObjective = $intermediateObjective;

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

    public function getTypeOffer(): ?string
    {
        return $this->typeOffer;
    }

    public function setTypeOffer(?string $typeOffer): self
    {
        $this->typeOffer = $typeOffer;

        return $this;
    }


}
