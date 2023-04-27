<?php

namespace App\Artists\Domain\Entity;

use App\Customers\Domain\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Uid\UuidV4;

class Playlist{

    #[
        Id,
        Column(type: 'string'),
    ]
    private string $id;

    #[Column]
    private ?string $name = null;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'playlists')]
    private User $user;

    #[OneToMany(mappedBy: 'playlists', targetEntity: Song::class)]
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

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return User
     */
    public function getUser(): User
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
     * @return ArrayCollection|Collection
     */
    public function getSongs(): ArrayCollection|Collection
    {
        return $this->songs;
    }

    /**
     * @param ArrayCollection|Collection $songs
     */
    public function setSongs(ArrayCollection|Collection $songs): void
    {
        $this->songs = $songs;
    }


}