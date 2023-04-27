<?php

namespace App\Artists\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Uid\UuidV4;

#[Entity]
class Album
{
    #[
        Id,
        Column(type: 'string'),
    ]
    private string $id;

    #[Column]
    private ?string $name = null;

    #[ManyToOne(targetEntity: Artist::class, inversedBy: 'artists')]
    private Artist $artist;

    #[OneToMany(mappedBy: 'album', targetEntity: Song::class)]
    private Collection $songs;

    public function __construct()
    {
        $this->id = (string) (new UuidV4());
        $this->songs = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function setArtist(Artist $artist): Album
    {
        $this->artist = $artist;

        return $this;
    }

    public function setName(?string $name): Album
    {
        $this->name = $name;

        return $this;
    }

    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): Album
    {
        $this->songs->add($song);

        return $this;
    }

    public function removeSong(Song $song): Album
    {
        $this->songs->removeElement($song);

        return $this;
    }
}