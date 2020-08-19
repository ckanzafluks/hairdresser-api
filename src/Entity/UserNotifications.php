<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserNotificationsRepository")
 */
class UserNotifications
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $profil_interest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $compatibility;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contract_proposition;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new_message;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new_comment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contract_update;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $assurance_update;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userNotifications", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new_contract;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new_session;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $session_canceled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $session_finished;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new_rating;

    public function getAttributes() {
        return get_object_vars($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?bool
    {
        return $this->telephone;
    }

    public function setTelephone(?bool $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?bool
    {
        return $this->mail;
    }

    public function setMail(?bool $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getProfilInterest(): ?bool
    {
        return $this->profil_interest;
    }

    public function setProfilInterest(?bool $profil_interest): self
    {
        $this->profil_interest = $profil_interest;

        return $this;
    }

    public function getCompatibility(): ?bool
    {
        return $this->compatibility;
    }

    public function setCompatibility(?bool $compatibility): self
    {
        $this->compatibility = $compatibility;

        return $this;
    }

    public function getContractProposition(): ?bool
    {
        return $this->contract_proposition;
    }

    public function setContractProposition(?bool $contract_proposition): self
    {
        $this->contract_proposition = $contract_proposition;

        return $this;
    }

    public function getNewMessage(): ?bool
    {
        return $this->new_message;
    }

    public function setNewMessage(?bool $new_message): self
    {
        $this->new_message = $new_message;

        return $this;
    }

    public function getNewComment(): ?bool
    {
        return $this->new_comment;
    }

    public function setNewComment(?bool $new_comment): self
    {
        $this->new_comment = $new_comment;

        return $this;
    }

    public function getContractUpdate(): ?bool
    {
        return $this->contract_update;
    }

    public function setContractUpdate(?bool $contract_update): self
    {
        $this->contract_update = $contract_update;

        return $this;
    }

    public function getAssuranceUpdate(): ?bool
    {
        return $this->assurance_update;
    }

    public function setAssuranceUpdate(?bool $assurance_update): self
    {
        $this->assurance_update = $assurance_update;

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

    public function getNewContract(): ?bool
    {
        return $this->new_contract;
    }

    public function setNewContract(?bool $new_contract): self
    {
        $this->new_contract = $new_contract;

        return $this;
    }

    public function getNewSession(): ?bool
    {
        return $this->new_session;
    }

    public function setNewSession(?bool $new_session): self
    {
        $this->new_session = $new_session;

        return $this;
    }

    public function getSessionCanceled(): ?bool
    {
        return $this->session_canceled;
    }

    public function setSessionCanceled(?bool $session_canceled): self
    {
        $this->session_canceled = $session_canceled;

        return $this;
    }

    public function getSessionFinished(): ?bool
    {
        return $this->session_finished;
    }

    public function setSessionFinished(?bool $session_finished): self
    {
        $this->session_finished = $session_finished;

        return $this;
    }

    public function getNewRating(): ?bool
    {
        return $this->new_rating;
    }

    public function setNewRating(?bool $new_rating): self
    {
        $this->new_rating = $new_rating;

        return $this;
    }
}
