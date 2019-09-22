<?php

namespace App\Controller;

use Core\Controller;
use App\Model\UserModel;

final class UserController extends Controller
{
    public function indexAction()
    {
        $model = new UserModel();
        $infos = $model->setId($_SESSION['user_id'])->getRecord();
        self::render('index', $infos);
    }

    public function addAction()
    {
        $model = new UserModel();
        $email = $this->request->getParam('email');
        $pwd = $this->request->getParam('pwd');
        if($email === null || $pwd === null) {
            self::render('register');
        } else if(
            preg_match('/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $email) !== 1
            || !empty($model->fetch(['WHERE' => 'email = \'' . $email . '\''])[0])
        ) {
            self::render('register', ['error' => true]);
        } else {
            $input = $model
                ->setEmail($email)
                ->setPassword($pwd)
                ->setPrenom($this->request->getParam('prenom'))
                ->setNom($this->request->getParam('nom'))
                ->save();
            if($input === false) {
                self::render('register', ['error' => true]);
            } else {
                header('Location: /PiePHP/login');
            }
        }
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
        $model = new UserModel();
        $email = $this->request->getParam('email');
        if($email !== null) {
            $results = $model->fetch(
                [
                'WHERE' => 'email = \''
                    . $email
                    . '\''
                ]
            );
            if(password_verify($this->request->getParam('pwd'), $results[0]['password']) === true) {
                $_SESSION['user_id'] = $results[0]['id'];
                header('location: /PiePHP/');
            } else {
                self::render('login', ['error' => true]);
            }
        } else {
            self::render('login');
        }
    }

    public function logoutAction()
    {
        session_destroy();
        header('location: /PiePHP/');
    }

    public function updateInfosAction()
    {
        $model = new UserModel();
        $email = $this->request->getParam('email');
        $nom = $this->request->getParam('nom');
        $prenom = $this->request->getParam('prenom');
        $order = [];
        if($email !== null) {
            if(preg_match('/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $email) !== 1
            || !empty($model->fetch(['WHERE' => 'email = \'' . $email . '\''])[0])) {
                echo 'Email incorrect ou dejà utilisé |';
            } else {
                $order['email'] = $email;
            }
        }
        if($nom !== null)
            $order['nom'] = $nom;
        if($prenom !== null)
            $order['prenom'] = $prenom;
        $input = $model->changeInfos($order, $_SESSION['user_id']);
        if($input === true) {
            foreach($order as $index => $value)
                echo ucfirst($index) . ' changé |';
        } else {
            echo 'Erreur dans le traitement de la requête |';
        }
    }

    public function updatePasswordAction()
    {
        $model = new UserModel();
        $oldPassword = $this->request->getParam('oldPwd');
        $hashedPwd = $model->getRecord($_SESSION['user_id'])['password'];
        $newPwd = $this->request->getParam('newPwd');

        if(password_verify($oldPassword, $hashedPwd) === true) {
            if($newPwd === '' || $newPwd === null) {
                echo 'Nouveau mot de passe vide';
            } else {
                $input = $model->changeInfos(
                    ['password' => password_hash($newPwd, PASSWORD_ARGON2I)],
                    $_SESSION['user_id']
                );
                echo $input === true
                    ? 'Changement effectué avec succès'
                    : 'Erreur dans le traitement de la requête';
            }
        } else {
            echo 'Les mots de passes ne correspondent pas';
        }
    }
}
