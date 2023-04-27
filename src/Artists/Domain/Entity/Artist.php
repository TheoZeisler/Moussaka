<?php

namespace App\Artists\Domain\Entity;

use App\Customers\Domain\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Uid\UuidV4;

#[Entity]
class Artist{

    #[
        Id,
        Column(type: 'string', nullable: false),
        GeneratedValue
    ]
    private string $id;

    #[Column]
    private ?string $name = null;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'artists')]
    private ?User $user = null;

    #[OneToMany(mappedBy: 'artists', targetEntity: Album::class)]
    private Collection $albums;

    /**
     * @var Collection<Song>
     */
    private Collection $songs;

    public function __construct(){
        $this->id = (string) (new UuidV4());
        $this->songs = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * @param Collection $albums
     */
    public function setAlbums(Collection $albums): void
    {
        $this->albums = $albums;
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return User
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    /**
     * @param Collection $songs
     */
    public function setSongs(Collection $songs): void
    {
        $this->songs = $songs;
    }

}