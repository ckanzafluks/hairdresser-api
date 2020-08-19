<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdsRepository")
 */
class Ads
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;


    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads", fetch="EAGER")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="ads", fetch="EAGER")
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="ads")
     */
    private $subCategory;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experiancesannees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medias", mappedBy="ads")
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsAuthor", mappedBy="objectif")
     */
    private $contractsAuthor;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsMessages", mappedBy="ads")
     */
    private $contractsMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Presession", mappedBy="objectif")
     */
    private $presessions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Presession", mappedBy="objectif")
     */
    private $ojectifPresession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="ads")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserFileIdentity", mappedBy="ads")
     */
    private $userFileIdentities;


  

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->medias  = new ArrayCollection();
        $this->contractsAuthor = new ArrayCollection();
        $this->contractsMessages = new ArrayCollection();
        $this->presessions = new ArrayCollection();
        $this->ojectifPresession = new ArrayCollection();
        $this->userFileIdentities = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function getExperiancesannees(): ?int
    {
        return $this->experiancesannees;
    }

    public function setExperiancesannees(?int $experiancesannees): self
    {
        $this->experiancesannees = $experiancesannees;

        return $this;
    }

    /**
     * @return Collection|Medias[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Medias $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setAds($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): self
    {
        if ($this->medias->contains($media)) {
            $this->medias->removeElement($media);
            // set the owning side to null (unless already changed)
            if ($media->getAds() === $this) {
                $media->setAds(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContractsAuthor[]
     */
    public function getContractsAuthor(): Collection
    {
        return $this->contractsAuthor;
    }

    public function addContract(ContractsAuthor $contractsAuthor): self
    {
        if (!$this->contractsAuthor->contains($contractsAuthor)) {
            $this->contractsAuthor[] = $contractsAuthor;
            $contractsAuthor->setObjectif($this);
        }

        return $this;
    }

    public function removeContractAuthor(ContractsAuthor $contractsAuthor): self
    {
        if ($this->contractsAuthor->contains($contractsAuthor)) {
            $this->contractsAuthor->removeElement($contractsAuthor);
            // set the owning side to null (unless already changed)
            if ($contractsAuthor->getObjectif() === $this) {
                $contractsAuthor->setObjectif(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

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
            $contractsMessage->setAds($this);
        }

        return $this;
    }

    public function removeContractsMessage(ContractsMessages $contractsMessage): self
    {
        if ($this->contractsMessages->contains($contractsMessage)) {
            $this->contractsMessages->removeElement($contractsMessage);
            // set the owning side to null (unless already changed)
            if ($contractsMessage->getAds() === $this) {
                $contractsMessage->setAds(null);
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
            $presession->setAdsobjectif($this);
        }

        return $this;
    }

    public function removePresession(Presession $presession): self
    {
        if ($this->presessions->contains($presession)) {
            $this->presessions->removeElement($presession);
            // set the owning side to null (unless already changed)
            if ($presession->getAdsobjectif() === $this) {
                $presession->setAdsobjectif(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Presession[]
     */
    public function getOjectifPresession(): Collection
    {
        return $this->ojectifPresession;
    }

    public function addOjectifPresession(Presession $ojectifPresession): self
    {
        if (!$this->ojectifPresession->contains($ojectifPresession)) {
            $this->ojectifPresession[] = $ojectifPresession;
            $ojectifPresession->setObjectif($this);
        }

        return $this;
    }

    public function removeOjectifPresession(Presession $ojectifPresession): self
    {
        if ($this->ojectifPresession->contains($ojectifPresession)) {
            $this->ojectifPresession->removeElement($ojectifPresession);
            // set the owning side to null (unless already changed)
            if ($ojectifPresession->getObjectif() === $this) {
                $ojectifPresession->setObjectif(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|UserFileIdentity[]
     */
    public function getUserFileIdentities(): Collection
    {
        return $this->userFileIdentities;
    }

    public function addUserFileIdentity(UserFileIdentity $userFileIdentity): self
    {
        if (!$this->userFileIdentities->contains($userFileIdentity)) {
            $this->userFileIdentities[] = $userFileIdentity;
            $userFileIdentity->setAds($this);
        }

        return $this;
    }

    public function removeUserFileIdentity(UserFileIdentity $userFileIdentity): self
    {
        if ($this->userFileIdentities->contains($userFileIdentity)) {
            $this->userFileIdentities->removeElement($userFileIdentity);
            // set the owning side to null (unless already changed)
            if ($userFileIdentity->getAds() === $this) {
                $userFileIdentity->setAds(null);
            }
        }

        return $this;
    }
    




    
}
