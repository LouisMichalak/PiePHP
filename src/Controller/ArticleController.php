<?php

namespace App\Controller;

use Core\Controller;
use App\Model\ArticleModel;
use App\Model\CommentModel;

final class ArticleController extends Controller
{
    public function relationsAction()
    {
        self::render('relations');
        $model = new ArticleModel();
        $model->setId(1);
        $model->linkRelation('tag', [4, 2, 1], true);
        var_dump($model->fetch());
    }
}
