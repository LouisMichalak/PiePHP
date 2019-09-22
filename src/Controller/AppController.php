<?php

namespace App\Controller;

use Core\Controller;
use App\Model\FilmModel;

final class AppController extends Controller
{
    public function indexAction()
    {
        $filmModel = new FilmModel();
        $results = $filmModel->fetch();
        self::render('index', ['films' => $results]);
    }
}