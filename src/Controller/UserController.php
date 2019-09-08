<?php

namespace App\Controller;

use Core\Controller;
use Core\Request;
use App\Model\UserModel;

final class UserController extends Controller
{
    /**
     * render register form view
     */
    public function addAction()
    {
        self::render('register');
    }

    /**
     * instanciate UserModel and call save method
     */
    public function registerAction()
    {
        (new UserModel())
            ->setEmail($_POST['email'])
            ->setPassword($_POST['pwd'])
            ->save();
    }

    public function showAction()
    {
        self::render('show');
    }
    
    /**
     * render login form view
     */
    public function loginAction()
    {
        self::render('login');
    }
}
