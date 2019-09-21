<?php

namespace App\Model;

use Core\Entity;

final class CommentModel extends Entity
{
    private static $relations = ['has one article'];

    private $content = '';

    private $article_id = '';

    public function __construct()
    {
        parent::__construct('comment');
    }

    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    public function setArticle_id(string $article_id)
    {
        $this->article_id = $article_id;
        return $this;
    }
}
