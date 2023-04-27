<?php

namespace App\Artists\Domain\Entity;


use App\Artists\Domain\Repository\SongRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $filePath = null;

    private ?File $file = null;

    #[ORM\OneToMany(mappedBy: 'songs', targetEntity: Album::class)]
    private ?Collection $album = null;

    #[ORM\ManyToMany(mappedBy: 'songs', targetEntity: Artist::class)]
    private ?Collection $artists = null;

    /**
     * @return Collection|null
     */
    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    /**
     * @param Collection|null $album
     */
    public function setAlbum(?Album $album): void
    {
        $this->album = $album;
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getfilePath(): ?string
    {
        return $this->filePath;
    }

    public function setfilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getArtists(): ?Collection
    {
        return $this->artists;
    }

    /**
     * @param Collection|null $artists
     */
    public function setArtists(?Collection $artists): void
    {
        $this->artists = $artists;
    }
}
