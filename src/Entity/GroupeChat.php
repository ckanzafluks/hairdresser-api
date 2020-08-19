<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeChatRepository")
 * 
 */
class GroupeChat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $createBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messagerie", mappedBy="groupechat")
     */
    private $messageries;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="groupechats1")
     */
    private $user01;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="groupechats2")
     */
    private $user02;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastMessage;

    public function __construct()
    {
        $this->messageries = new ArrayCollection();
        $date = new \Datetime();
        $this->lastMessage = $date->format('Y-m-d H:i:s');
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser01(): ?string
    {
        return $this->user01;
    }

    public function setUser01(User $user01): self
    {
        $this->user01 = $user01;

        return $this;
    }

    public function getUser02(): ?string
    {
        return $this->user02;
    }

    public function setUser02(User $user02): self
    {
        $this->user02 = $user02;

        return $this;
    }

    public function getCreateBy(): ?int
    {
        return $this->createBy;
    }

    public function setCreateBy(int $createBy): self
    {
        $this->createBy = $createBy;

        return $this;
    }

    /**
     * @return Collection|Messagerie[]
     */
    public function getMessageries(): Collection
    {
        return $this->messageries;
    }

    public function addMessagery(Messagerie $messagery): self
    {
        if (!$this->messageries->contains($messagery)) {
            $this->messageries[] = $messagery;
            $messagery->setGroupechat($this);
        }

        return $this;
    }

    public function removeMessagery(Messagerie $messagery): self
    {
        if ($this->messageries->contains($messagery)) {
            $this->messageries->removeElement($messagery);
            // set the owning side to null (unless already changed)
            if ($messagery->getGroupechat() === $this) {
                $messagery->setGroupechat(null);
            }
        }

        return $this;
    }
    
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

   
    public function setLastMessage($lastMessage)
    {
        $this->lastMessage = $lastMessage;
    }

    
   



}
