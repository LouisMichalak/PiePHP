<?php

namespace Core;

use Core\Database;

final class ORM extends Database
{
    /**
     * insert into a table with fields concerned
     * 
     * @param string $table name of the table
     * @param array $fields array containing fields associate to their values
     * @return int|bool return id of the new row of your database or false if an error occure
     */
    public function create (string $table, array $fields)
    {
    //    $sql 

        
    }

    /**
     * 
     */
    public function read ($table, $id)
    {

    }

    /**
     * 
     */
    public function update ($table, $id, $fields)
    {

    }

    /**
     * 
     */
    public function delete ($table, $id)
    {

    }

    /**
     * 
     */
    public function find (
        $table,
        $params = array('WHERE' => '1','ORDER BY' => 'id ASC','LIMIT' => '')
    ) {

    }
}
