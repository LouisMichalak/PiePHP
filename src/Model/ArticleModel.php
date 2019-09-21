<?php

namespace App\Model;

use Core\Entity;

final class ArticleModel extends Entity
{
    private static $relations = ['has many comment', 'has many tag'];

    private $content = '';

    public function __construct()
    {
        parent::__construct('article');
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
