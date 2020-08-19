<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagerieRepository")
 * @Serializer\ExclusionPolicy("none")
 */
class Messagerie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="ce champs ne peux pas être vide !")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messageries")
     * @Serializer\Exclude
     */
    private $users;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $readCheckEmetteur;

    /**
     * @ORM\Column(type="boolean")
     *
     */
    private $readCheckDestinataire;


    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupeChat", inversedBy="messageries")
     * @Serializer\Exclude
     */
    private $groupechat;



    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;
    
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getObjet()
    {
        return $this->objet;
    }

    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessages(): ?string
    {
        return $this->messages;
    }

    public function setMessages(string $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

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

    public function getGroupechat(): ?GroupeChat
    {
        return $this->groupechat;
    }

    public function setGroupechat(?GroupeChat $groupechat): self
    {
        $this->groupechat = $groupechat;

        return $this;
    }

    public function getDestinataire(): ?User
    {
        return $this->destinataire;
    }

    public function setDestinataire(?User $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getSource(): ?User
    {
        return $this->source;
    }

    public function setSource(?User $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return mixed
     */


    public function getReadCheckEmetteur()
    {
        return $this->readCheckEmetteur;
    }

    /**
     * @param mixed $readCheckEmetteur
     */
    public function setReadCheckEmetteur($readCheckEmetteur): void
    {
        $this->readCheckEmetteur = $readCheckEmetteur;
    }

    /**
     * @return mixed
     */
    public function getReadCheckDestinataire()
    {
        return $this->readCheckDestinataire;
    }

    /**
     * @param mixed $readCheckDestinataire
     */
    public function setReadCheckDestinataire($readCheckDestinataire): void
    {
        $this->readCheckDestinataire = $readCheckDestinataire;
    }
}
