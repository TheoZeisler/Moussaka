<?php

namespace App\Artists\Infrastructure\Symfony\Model;

use App\Artists\Domain\Entity\Artist;

class Album{

    public function __construct(
        public readonly Artist $artist,
    )   {}
}