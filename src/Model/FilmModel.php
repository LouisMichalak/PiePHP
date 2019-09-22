<?php

namespace App\Model;

use Core\Entity;

final class FilmModel extends Entity
{
    private static $relations = ['has one genre'];

    private $nom = '';

    private $duree = '';

    private $resume = '';

    private $genre_id = '';

    public function __construct()
    {
        parent::__construct('film');
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function setDuree(string $duree)
    {
        $this->duree = $duree;
        return $this;
    }

    public function setResume(string $resume)
    {
        $this->resume = $resume;
        return $this;
    }

    public function setGenre_id(string $genre_id)
    {
        $this->genre_id = $genre_id;
        return $this;
    }
}
