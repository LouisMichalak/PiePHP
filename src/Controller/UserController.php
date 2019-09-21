<?php

namespace App\Controller;

use Core\Controller;
use App\Model\UserModel;

final class UserController extends Controller
{
    public function addAction()
    {
        self::render('register');
    }

    public function registerAction()
    {
        (new UserModel('users'))
            ->setEmail($this->request->getParam('email'))
            ->setPassword($this->request->getParam('pwd'))
            ->save();
    }

    public function showAction($id)
    {
        self::render('show');
        //var_dump($id);
        //$model = new UserModel();
        /*var_dump($model
            ->setId(26)
            ->changeInfos(['password' => 'kekkkek']));
        var_dump($model
            ->getRecords());
        var_dump($model
            ->deleteRecords());
        var_dump($model
            ->setId(28)
            ->load()
        );
        var_dump($model
            ->fetch(
                [
                    'ORDER BY' => 'id DESC',
                    'LIMIT' => '10'
                ]
            )
        );*/
    }
    
    /**
     * render login form view
     */
    public function loginAction()
    {
        self::render('login');
    }
}
