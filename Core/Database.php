<?php

namespace Core;

abstract class Database
{
    /**
     * @var string $host name of the host used
     * @example $host 'localhost'
     */
    private $host = '';

    /**
     * @var string $name name of the database used
     */
    private $dbName = '';

    /**
     * @var string $username name of user who connect to database
     * @example $username 'root'
     */
    private $username = '';

    /**
     * @var string $password password associate to the database
     */
    private $password = '';

    /**
     * @var object $db PDOStatement instance
     */
    private $pdoObj = null;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbName = 'piephp';
        $this->username = 'root';

        $connectInfo = 'mysql:host='. $this->host .';dbname='. $this->dbName;

        //Error display on connection to database
        try {
            $this->pdoObj = new \PDO(
                $connectInfo,
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * execute SQL query with PDOStatement Object
     * 
     * @param string $query query to execute
     * @return string|bool result of the query execution
     */
    protected function executeQuery(string $query)
    {

    }
}
