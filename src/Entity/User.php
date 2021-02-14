<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;

use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Serializer\ExclusionPolicy("ALL")
 * @UniqueEntity(
 *   fields={"email"},
 *   errorPath="email",
 *   message="Un compte avec cette adresse email existe déjà!"
 * )
 * @UniqueEntity(fields={"username"}, message="Un compte avec ce pseudo existe déjà!")
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "api_users",
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "getById",
 *      href = @Hateoas\Route(
 *          "api_users_id",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $complementAddress;

    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $postalCode;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $city;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $typeUser;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $descriptionProfil;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $country;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Civility", inversedBy="users")
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $photo;

    // ici on redéfini les paramètres de la classe FosUserBundle

    /**
     * @Serializer\Expose
     * @Serializer\Groups({"get", "create", "update"})
     */
    protected $password;

    /**
     * @var string
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $username;

    /**
     * @var string
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $usernameCanonical;

    /**
     * @var string
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $email;

    /**
     * @var string
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $emailCanonical;

    /**
     * @var bool
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    protected $enabled;

    /**
     * The salt to use for hashing.
     *
     * @Serializer\Expose
     * @Serializer\Groups({ "list", "details", "create"})
     */
    protected $salt;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"create", "update"})
     */
    protected $plainPassword;

    /**
     *
     * @var \DateTime|null
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     * @Serializer\Expose
     * @JMS\Serializer\Annotation\Type("string")
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $confirmationToken;

    /**
     * @var \DateTime|null
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $passwordRequestedAt;

    /**
     * @var
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create"})
     */
    protected $groups;

    // fin redefinition


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Votes", mappedBy="idAuthor")
     * @Serializer\Expose
     */
    private $votes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $phone1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $phone2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messagerie", mappedBy="users")
     */
    private $messageries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupeChat", mappedBy="user01")
     */
    private $groupechats1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupeChat", mappedBy="user02")
     */
    private $groupechats2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ads", mappedBy="user", fetch="EAGER")
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medias", mappedBy="user")
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserWishes", mappedBy="user")
     */
    private $wishes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCalendar", mappedBy="user")
     */
    private $userCalendars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractsMessages", mappedBy="author")
     */
    private $contractsMessages;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $stripeCustomerId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Presession", mappedBy="author")
     */
    private $presessions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionRatings", mappedBy="author")
     */
    private $sessionRatings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserFileIdentity", mappedBy="user")
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $userFileIdentities;

    /**
     *
     *
     * @var string
     * @Serializer\Exclude
     */
    protected $roles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $jwtToken;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Serializer\Expose
     * @Serializer\Groups({"get", "list", "details", "create", "update"})
     */
    private $enterprise_name;


    public function __construct()
    {
        parent::__construct();


        if ( function_exists('runkit_method_removrunkit_method_remove') ) {
            runkit_method_removrunkit_method_remove(
                'BaseUser',
                '__toString'
            );
        }

        $this->votes = new ArrayCollection();
        $this->messageries = new ArrayCollection();
        $this->groupechats1 = new ArrayCollection();
        $this->groupechats2 = new ArrayCollection();
        $this->enabled = 1;
        $this->ads = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->wishes = new ArrayCollection();
        $this->userCalendars = new ArrayCollection();
        $this->contractsMessages = new ArrayCollection();
        $this->presessions = new ArrayCollection();
        $this->sessionRatings = new ArrayCollection();
        $this->userFileIdentities = new ArrayCollection();

        // your own logic
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function getComplementAddress(){
        return $this->complementAddress;
    }

    public function setComplementAddress($complementAddress){
        $this->complementAddress = $complementAddress;
    }

    public function getPostalCode(){
        return $this->postalCode;
    }

    public function setPostalCode($postalCode){
        $this->postalCode = $postalCode;
    }

    public function getCity(){
        return $this->city;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function getTypeUser(){
        return $this->typeUser;
    }

    public function setTypeUser($typeUser){
        $this->typeUser = $typeUser;
    }

    public function getDescriptionProfil(){
        return $this->descriptionProfil;
    }

    public function setDescriptionProfil($descriptionProfil){
        $this->descriptionProfil = $descriptionProfil;
    }

    public function getCreated(){
        return $this->created;
    }

    public function setCreated($created){
        $this->created = $created;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

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

    public function getCivility(): ?Civility
    {
        return $this->civility;
    }

    public function setCivility(?Civility $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Votes[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Votes $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setIdAuthor($this);
        }

        return $this;
    }

    public function removeVote(Votes $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getIdAuthor() === $this) {
                $vote->setIdAuthor(null);
            }
        }

        return $this;
    }

    public function getPhone1(): ?string
    {
        return $this->phone1;
    }

    public function setPhone1(?string $phone1): self
    {
        $this->phone1 = $phone1;

        return $this;
    }

    public function getPhone2(): ?string
    {
        return $this->phone2;
    }

    public function setPhone2(?string $phone2): self
    {
        $this->phone2 = $phone2;

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
            $messagery->setUsers($this);
        }

        return $this;
    }

    public function removeMessagery(Messagerie $messagery): self
    {
        if ($this->messageries->contains($messagery)) {
            $this->messageries->removeElement($messagery);
            // set the owning side to null (unless already changed)
            if ($messagery->getUsers() === $this) {
                $messagery->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeChat[]
     */
    public function getGroupechats1(): Collection
    {
        return $this->groupechats1;
    }

    public function addGroupechats1(GroupeChat $groupechats1): self
    {
        if (!$this->groupechats1->contains($groupechats1)) {
            $this->groupechats1[] = $groupechats1;
            $groupechats1->setUser01($this);
        }

        return $this;
    }

    public function removeGroupechats1(GroupeChat $groupechats1): self
    {
        if ($this->groupechats1->contains($groupechats1)) {
            $this->groupechats1->removeElement($groupechats1);
            // set the owning side to null (unless already changed)
            if ($groupechats1->getUser01() === $this) {
                $groupechats1->setUser01(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeChat[]
     */
    public function getGroupechats2(): Collection
    {
        return $this->groupechats2;
    }

    public function addGroupechats2(GroupeChat $groupechats2): self
    {
        if (!$this->groupechats2->contains($groupechats2)) {
            $this->groupechats2[] = $groupechats2;
            $groupechats2->setUser02($this);
        }

        return $this;
    }

    public function removeGroupechats2(GroupeChat $groupechats2): self
    {
        if ($this->groupechats2->contains($groupechats2)) {
            $this->groupechats2->removeElement($groupechats2);
            // set the owning side to null (unless already changed)
            if ($groupechats2->getUser02() === $this) {
                $groupechats2->setUser02(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ads[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ads $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setUser($this);
        }
        return $this;
    }

    public function removeAd(Ads $ad): self
    {
        if ($this->ads->contains($ad)) {
            $this->ads->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getUser() === $this) {
                $ad->setUser(null);
            }
        }
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
            $media->setUser($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): self
    {
        if ($this->medias->contains($media)) {
            $this->medias->removeElement($media);
            // set the owning side to null (unless already changed)
            if ($media->getUser() === $this) {
                $media->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserWishes[]
     */
    public function getWishes(): Collection
    {
        return $this->wishes;
    }

    public function addWish(UserWishes $wish): self
    {
        if (!$this->wishes->contains($wish)) {
            $this->wishes[] = $wish;
            $wish->setUser($this);
        }

        return $this;
    }


    /**
     * @return Collection|UserCalendar[]
     */
    public function getUserCalendars(): Collection
    {
        return $this->userCalendars;
    }

    public function addUserCalendar(UserCalendar $userCalendar): self
    {
        if (!$this->userCalendars->contains($userCalendar)) {
            $this->userCalendars[] = $userCalendar;
            $userCalendar->setUser($this);
        }

        return $this;
    }

    public function removeUserCalendar(UserCalendar $userCalendar): self
    {
        if ($this->userCalendars->contains($userCalendar)) {
            $this->userCalendars->removeElement($userCalendar);
            // set the owning side to null (unless already changed)
            if ($userCalendar->getUser() === $this) {
                $userCalendar->setUser(null);
            }
        }

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
            $contractsMessage->setAuthor($this);
        }

        return $this;
    }

    public function removeContractsMessage(ContractsMessages $contractsMessage): self
    {
        if ($this->contractsMessages->contains($contractsMessage)) {
            $this->contractsMessages->removeElement($contractsMessage);
            // set the owning side to null (unless already changed)
            if ($contractsMessage->getAuthor() === $this) {
                $contractsMessage->setAuthor(null);
            }
        }

        return $this;
    }

    public function getStripeCustomerId(): ?string
    {
        return $this->stripeCustomerId;
    }

    public function setStripeCustomerId(?string $stripeCustomerId): self
    {
        $this->stripeCustomerId = $stripeCustomerId;

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
            $presession->setUserauteur($this);
        }

        return $this;
    }

    public function removePresession(Presession $presession): self
    {
        if ($this->presessions->contains($presession)) {
            $this->presessions->removeElement($presession);
            // set the owning side to null (unless already changed)
            if ($presession->getUserauteur() === $this) {
                $presession->setUserauteur(null);
            }
        }

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
            $sessionRating->setAuthor($this);
        }

        return $this;
    }

    public function removeSessionRating(SessionRatings $sessionRating): self
    {
        if ($this->sessionRatings->contains($sessionRating)) {
            $this->sessionRatings->removeElement($sessionRating);
            // set the owning side to null (unless already changed)
            if ($sessionRating->getAuthor() === $this) {
                $sessionRating->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     *
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
            $userFileIdentity->setUser($this);
        }

        return $this;
    }

    public function removeUserFileIdentity(UserFileIdentity $userFileIdentity): self
    {
        if ($this->userFileIdentities->contains($userFileIdentity)) {
            $this->userFileIdentities->removeElement($userFileIdentity);
            // set the owning side to null (unless already changed)
            if ($userFileIdentity->getUser() === $this) {
                $userFileIdentity->setUser(null);
            }
        }

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $jwtToken): self
    {
        $this->token = $jwtToken;

        return $this;
    }

    public function getJwtToken(): ?string
    {
        return $this->jwtToken;
    }

    public function setJwtToken(?string $jwtToken): self
    {
        $this->jwtToken = $jwtToken;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getEnterpriseName(): ?string
    {
        return $this->enterprise_name;
    }

    public function setEnterpriseName(?string $enterprise_name): self
    {
        $this->enterprise_name = $enterprise_name;

        return $this;
    }

}