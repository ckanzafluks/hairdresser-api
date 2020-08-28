<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
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
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $created;


    /**
     * @ORM\Column(type="time", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads", fetch="EAGER")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="ads")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $subCategory;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $experiancesannees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medias", mappedBy="ads")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $medias;


    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsMessages", mappedBy="ads")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $contractsMessages;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="ads")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $category;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;



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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
    




    
}
