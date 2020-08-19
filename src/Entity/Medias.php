<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediasRepository")
 */
class Medias
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="medias")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediasArticles", mappedBy="medias")
     */
    private $mediasArticles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediasMusics", mappedBy="medias")
     */
    private $mediasMusics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediasPhotos", mappedBy="medias")
     */
    private $mediasPhotos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediasVideos", mappedBy="medias")
     */
    private $mediasVideos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="medias")
     */
    private $ads;



    public function __construct()
    {
        $this->mediasArticles = new ArrayCollection();
        $this->mediasMusics = new ArrayCollection();
        $this->mediasPhotos = new ArrayCollection();
        $this->mediasVideos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|MediasArticles[]
     */
    public function getMediasArticles(): Collection
    {
        return $this->mediasArticles;
    }

    public function addMediasArticle(MediasArticles $mediasArticle): self
    {
        if (!$this->mediasArticles->contains($mediasArticle)) {
            $this->mediasArticles[] = $mediasArticle;
            $mediasArticle->setMedias($this);
        }

        return $this;
    }

    public function removeMediasArticle(MediasArticles $mediasArticle): self
    {
        if ($this->mediasArticles->contains($mediasArticle)) {
            $this->mediasArticles->removeElement($mediasArticle);
            // set the owning side to null (unless already changed)
            if ($mediasArticle->getMedias() === $this) {
                $mediasArticle->setMedias(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediasMusics[]
     */
    public function getMediasMusics(): Collection
    {
        return $this->mediasMusics;
    }

    public function addMediasMusic(MediasMusics $mediasMusic): self
    {
        if (!$this->mediasMusics->contains($mediasMusic)) {
            $this->mediasMusics[] = $mediasMusic;
            $mediasMusic->setMedias($this);
        }

        return $this;
    }

    public function removeMediasMusic(MediasMusics $mediasMusic): self
    {
        if ($this->mediasMusics->contains($mediasMusic)) {
            $this->mediasMusics->removeElement($mediasMusic);
            // set the owning side to null (unless already changed)
            if ($mediasMusic->getMedias() === $this) {
                $mediasMusic->setMedias(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediasPhotos[]
     */
    public function getMediasPhotos(): Collection
    {
        return $this->mediasPhotos;
    }

    public function addMediasPhoto(MediasPhotos $mediasPhoto): self
    {
        if (!$this->mediasPhotos->contains($mediasPhoto)) {
            $this->mediasPhotos[] = $mediasPhoto;
            $mediasPhoto->setMedias($this);
        }

        return $this;
    }

    public function removeMediasPhoto(MediasPhotos $mediasPhoto): self
    {
        if ($this->mediasPhotos->contains($mediasPhoto)) {
            $this->mediasPhotos->removeElement($mediasPhoto);
            // set the owning side to null (unless already changed)
            if ($mediasPhoto->getMedias() === $this) {
                $mediasPhoto->setMedias(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediasVideos[]
     */
    public function getMediasVideos(): Collection
    {
        return $this->mediasVideos;
    }

    public function addMediasVideo(MediasVideos $mediasVideo): self
    {
        if (!$this->mediasVideos->contains($mediasVideo)) {
            $this->mediasVideos[] = $mediasVideo;
            $mediasVideo->setMedias($this);
        }

        return $this;
    }

    public function removeMediasVideo(MediasVideos $mediasVideo): self
    {
        if ($this->mediasVideos->contains($mediasVideo)) {
            $this->mediasVideos->removeElement($mediasVideo);
            // set the owning side to null (unless already changed)
            if ($mediasVideo->getMedias() === $this) {
                $mediasVideo->setMedias(null);
            }
        }

        return $this;
    }

    public function getAds(): ?Ads
    {
        return $this->ads;
    }

    public function setAds(?Ads $ads): self
    {
        $this->ads = $ads;

        return $this;
    }


    
}