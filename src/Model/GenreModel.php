<?php

namespace App\Model;

use Core\Entity;

final class GenreModel extends Entity
{
    private static $relations = ['has many film'];

    private $genre = '';

    public function __construct()
    {
        parent::__construct('genre');
    }

    public function setGenre(string $genre)
    {
        $this->genre = $genre;
        return $this;
    }
}
