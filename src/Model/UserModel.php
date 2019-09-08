<?php

namespace App\Model;

use Core\Entity;

final class UserModel extends Entity
{
    /**
     * @var string $email email of a user in the BDD
     */
    private $email = '';

    /**
     * @var string $password password of a user in the BDD
     */
    private $password = '';

    /**
     * set email for the model
     * 
     * @param string $email email to use
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return($this);
    }

    /**
     * set password for the model
     * 
     * @param string $password password to use
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return($this);
    }

    /**
     * create a user
     */
    public function save()
    {
        $sql = 'INSERT INTO users (email, password) VALUES ('.$this->email.','.$this->password.')';
        $this->dbObj->execQuery($sql);
    }
}
