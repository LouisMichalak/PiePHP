<?php

namespace App\Model;

use Core\Entity;

final class UserModel extends Entity
{
    /**
     * @var array array containing relations with other tables
     * @example ['has many (table)', 'has one (table)']
     */
    private static $relations = [];

    /**
     * @var string $email email of a user in the BDD
     */
    private $email = '';

    /**
     * @var string $password password of a user in the BDD
     */
    private $password = '';

    /**
     * construct instance of the model
     * 
     * WARNING : YOU HAVE TO CALL ENTITY(PARENT) CONSTRUCT TO PASS TABLE USED
     */
    public function __construct()
    {
        parent::__construct('user');
    }

    /**
     * set email for the model
     * 
     * @param string $email email to use
     * @return object instance of the current object to chain
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * set password for the model
     * 
     * @param string $password password to use
     * @return object instance of the current object to chain
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}
