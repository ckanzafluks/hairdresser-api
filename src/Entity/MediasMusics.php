<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediasMusicsRepository")
 */
class MediasMusics
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pathfile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medias", inversedBy="mediasMusics")
     */
    private $medias;
    
    private $ads;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idParent;

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param mixed $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
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

    public function getPathfile(): ?string
    {
        return $this->pathfile;
    }

    public function setPathfile(?string $pathfile): self
    {
        $this->pathfile = $pathfile;

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

    public function getMedias(): ?Medias
    {
        return $this->medias;
    }

    public function setMedias(?Medias $medias): self
    {
        $this->medias = $medias;

        return $this;
    }
    
    public function traitementMusic(UploadedFile $file, $paramDirectory, $idUser)
    {
        $this->setName(uniqid().'.'.$file->getClientOriginalExtension());
        
        dump($paramDirectory);
        $file->move($paramDirectory.'/'.$idUser.'/MusicMedias', $this->name);
        $this->pathfile = '/uploads/users/'.$idUser.'/MUSICMedias/'.$this->name;
        
    }

    public function getIdParent(): ?int
    {
        return $this->idParent;
    }

    public function setIdParent(?int $idParent): self
    {
        $this->idParent = $idParent;

        return $this;
    }
}
