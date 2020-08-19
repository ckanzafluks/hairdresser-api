<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SessionsRepositor")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $proposed_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_canceled;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancel_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionRatings", mappedBy="session")
     */
    private $sessionRatings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $cancel_by;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Presession", inversedBy="sessions")
     */
    private $presession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $payment_intent_date;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $payment_intent_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $payment_status;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $paymentMethodId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cancel_reason;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $endCommentMentor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $endCommentMentore;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $cancelTooLateBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelTooLateDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $cancelTooLatedAcceptedBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $cancelTooLatedRefusedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelTooLatedAcceptedDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelTooLatedRefusedDate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amountRefound;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRefound;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amountPenality;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $amountPenalityDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $amountRefoundDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reportMentorDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reportMentorContent;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reportMentoreDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reportMentoreContent;

    public function __construct()
    {
        $this->sessionRatings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsCanceled(): ?bool
    {
        return $this->is_canceled;
    }

    public function setIsCanceled(?bool $is_canceled): self
    {
        $this->is_canceled = $is_canceled;

        return $this;
    }

    public function getCancelDate(): ?\DateTimeInterface
    {
        return $this->cancel_date;
    }

    public function setCancelDate(?\DateTimeInterface $cancel_date): self
    {
        $this->cancel_date = $cancel_date;

        return $this;
    }

    public function getProposedDate(): ?\DateTime
    {
        return $this->proposed_date;
    }

    public function setProposedDate(?\DateTime $proposed_date): self
    {
        $this->proposed_date = $proposed_date;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * @return Collection|SessionRatings[]
     */
    public function getSessionRatings(): Collection
    {
        return $this->sessionRatings;
    }

    public function addSessionRating(SessionRatings $sessionRating): self
    {
        if (!$this->sessionRatings->contains($sessionRating)) {
            $this->sessionRatings[] = $sessionRating;
            $sessionRating->setSession($this);
        }

        return $this;
    }

    public function removeSessionRating(SessionRatings $sessionRating): self
    {
        if ($this->sessionRatings->contains($sessionRating)) {
            $this->sessionRatings->removeElement($sessionRating);
            // set the owning side to null (unless already changed)
            if ($sessionRating->getSession() === $this) {
                $sessionRating->setSession(null);
            }
        }

        return $this;
    }

    public function getCancelBy(): ?User
    {
        return $this->cancel_by;
    }

    public function setCancelBy(?User $cancel_by): self
    {
        $this->cancel_by = $cancel_by;

        return $this;
    }

    public function getPresession(): ?Presession
    {
        return $this->presession;
    }

    public function setPresession(?Presession $presession): self
    {
        $this->presession = $presession;

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

    public function getPaymentIntentDate(): ?\DateTimeInterface
    {
        return $this->payment_intent_date;
    }

    public function setPaymentIntentDate(?\DateTimeInterface $payment_intent_date): self
    {
        $this->payment_intent_date = $payment_intent_date;

        return $this;
    }

    public function getPaymentIntentId(): ?string
    {
        return $this->payment_intent_id;
    }

    public function setPaymentIntentId(?string $payment_intent_id): self
    {
        $this->payment_intent_id = $payment_intent_id;

        return $this;
    }

    public function getPaymentStatus(): ?int
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(?int $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    public function getPaymentMethodId(): ?string
    {
        return $this->paymentMethodId;
    }

    public function setPaymentMethodId(?string $paymentMethodId): self
    {
        $this->paymentMethodId = $paymentMethodId;

        return $this;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function getCancelReason(): ?string
    {
        return $this->cancel_reason;
    }

    public function setCancelReason(?string $cancel_reason): self
    {
        $this->cancel_reason = $cancel_reason;

        return $this;
    }

    public function getEndCommentMentor(): ?string
    {
        return $this->endCommentMentor;
    }

    public function setEndCommentMentor(?string $endCommentMentor): self
    {
        $this->endCommentMentor = $endCommentMentor;

        return $this;
    }

    public function getEndCommentMentore(): ?string
    {
        return $this->endCommentMentore;
    }

    public function setEndCommentMentore(?string $endCommentMentore): self
    {
        $this->endCommentMentore = $endCommentMentore;

        return $this;
    }

    public function getCancelTooLateBy(): ?User
    {
        return $this->cancelTooLateBy;
    }

    public function setCancelTooLateBy(?User $cancelTooLateBy): self
    {
        $this->cancelTooLateBy = $cancelTooLateBy;

        return $this;
    }

    public function getCancelTooLateDate(): ?\DateTimeInterface
    {
        return $this->cancelTooLateDate;
    }

    public function setCancelTooLateDate(?\DateTimeInterface $cancelTooLateDate): self
    {
        $this->cancelTooLateDate = $cancelTooLateDate;

        return $this;
    }

    public function getCancelTooLatedAcceptedBy(): ?User
    {
        return $this->cancelTooLatedAcceptedBy;
    }

    public function setCancelTooLatedAcceptedBy(?User $cancelTooLatedAcceptedBy): self
    {
        $this->cancelTooLatedAcceptedBy = $cancelTooLatedAcceptedBy;

        return $this;
    }

    public function getCancelTooLatedRefusedBy(): ?User
    {
        return $this->cancelTooLatedRefusedBy;
    }

    public function setCancelTooLatedRefusedBy(?User $cancelTooLatedRefusedBy): self
    {
        $this->cancelTooLatedRefusedBy = $cancelTooLatedRefusedBy;

        return $this;
    }

    public function getCancelTooLatedAcceptedDate(): ?\DateTimeInterface
    {
        return $this->cancelTooLatedAcceptedDate;
    }

    public function setCancelTooLatedAcceptedDate(?\DateTimeInterface $cancelTooLatedAcceptedDate): self
    {
        $this->cancelTooLatedAcceptedDate = $cancelTooLatedAcceptedDate;

        return $this;
    }

    public function getCancelTooLatedRefusedDate(): ?\DateTimeInterface
    {
        return $this->cancelTooLatedRefusedDate;
    }

    public function setCancelTooLatedRefusedDate(?\DateTimeInterface $cancelTooLatedRefusedDate): self
    {
        $this->cancelTooLatedRefusedDate = $cancelTooLatedRefusedDate;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmountRefound(): ?string
    {
        return $this->amountRefound;
    }

    public function setAmountRefound(?string $amountRefound): self
    {
        $this->amountRefound = $amountRefound;

        return $this;
    }

    public function getDateRefound(): ?\DateTimeInterface
    {
        return $this->dateRefound;
    }

    public function setDateRefound(?\DateTimeInterface $dateRefound): self
    {
        $this->dateRefound = $dateRefound;

        return $this;
    }

    public function getAmountPenality(): ?string
    {
        return $this->amountPenality;
    }

    public function setAmountPenality(?string $amountPenality): self
    {
        $this->amountPenality = $amountPenality;

        return $this;
    }

    public function getAmountPenalityDate(): ?\DateTimeInterface
    {
        return $this->amountPenalityDate;
    }

    public function setAmountPenalityDate(?\DateTimeInterface $amountPenalityDate): self
    {
        $this->amountPenalityDate = $amountPenalityDate;

        return $this;
    }

    public function getAmountRefoundDate(): ?\DateTimeInterface
    {
        return $this->amountRefoundDate;
    }

    public function setAmountRefoundDate(?\DateTimeInterface $amountRefoundDate): self
    {
        $this->amountRefoundDate = $amountRefoundDate;

        return $this;
    }

    public function getReportMentorDate(): ?\DateTimeInterface
    {
        return $this->reportMentorDate;
    }

    public function setReportMentorDate(?\DateTimeInterface $reportMentorDate): self
    {
        $this->reportMentorDate = $reportMentorDate;

        return $this;
    }

    public function getReportMentorContent(): ?string
    {
        return $this->reportMentorContent;
    }

    public function setReportMentorContent(?string $reportMentorContent): self
    {
        $this->reportMentorContent = $reportMentorContent;

        return $this;
    }

    public function getReportMentoreDate(): ?\DateTimeInterface
    {
        return $this->reportMentoreDate;
    }

    public function setReportMentoreDate(?\DateTimeInterface $reportMentoreDate): self
    {
        $this->reportMentoreDate = $reportMentoreDate;

        return $this;
    }

    public function getReportMentoreContent(): ?string
    {
        return $this->reportMentoreContent;
    }

    public function setReportMentoreContent(?string $reportMentoreContent): self
    {
        $this->reportMentoreContent = $reportMentoreContent;

        return $this;
    }
}
