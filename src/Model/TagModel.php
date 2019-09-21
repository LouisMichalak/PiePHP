<?php

namespace App\Model;

use Core\Entity;

final class TagModel extends Entity
{
    private static $relations = ['has many article'];

    private $type = '';

    public function __construct()
    {
        parent::__construct('tag');
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }
}
