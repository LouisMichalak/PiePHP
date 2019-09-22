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
    public function create(string $table, array $fields)
    {
        $query = 'INSERT INTO ' . $table
            . $this->createFieldsBuilder(array_keys($fields))
            . ' VALUES ' . $this->createParamsBuilder($fields);
        $output = $this->executeQuery($query) == false
            ? false
            : $this->pdoObj->lastInsertId();
        return $output;
    }

    /**
     * build fields string for create request
     * 
     * @param bool $insertTester false or set to true if request is insert or update
     * @param array $fields array of string, values are field names
     * @return string builded string of fields
     */
    public function createFieldsBuilder(array $fields)
    {
        $builded = implode(', ', $fields);
        return '(' . $builded . ')';
    }

    /**
     * build params string for create request
     * 
     * @param array $fields array of string, values are param names
     * @return string builded string of values
     */
    public function createParamsBuilder(array $values)
    {
        $builded = implode('\', \'', $values);
        return '(\'' . $builded . '\')';
    }

    /**
     * return an array of a records in a table
     * 
     * @param string $table name of the table
     * @param string|int $id id associate to records
     * @return array|false records associate to $id or false if id doesn't exist
     */
    public function read (string $table, $id)
    {
        $id = gettype($id) === 'string' ? (int)$id : $id;
        $query = 'SELECT * FROM ' . $table . ' WHERE id = ' . $id;
        $output = $this->executeQuery($query);
        return $output === false
            ? false
            : $output->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * update fields in a table
     * 
     * @param string $table name of the table
     * @param string|int $id id associate to records
     * @param array $fields array containing fields addociate to their new values
     * @return bool return true if request succeed or false if an error occured
     */
    public function update (string $table, $id, array $fields)
    {
        $id = gettype($id) === 'string' ? (int)$id : $id;
        $query = 'UPDATE ' . $table . ' SET';
        $ctr = 0;
        foreach($fields as $field => $param) {
            $query .= ' ' . $field . ' = ' . '"' . $param . '"';
            $query .= count($fields) - 1 === $ctr
                ? ' WHERE id = ' . $id
                : ',';
            $ctr++;
        }
        return $this->executeQuery($query) === false ? false : true;
    }

    /**
     * delete records from a table
     * 
     * @param string $table name of the table
     * @param string|int $id id associate to record
     * @return bool return true if request succeed or false if an error occured
     */
    public function delete (string $table, $id)
    {
        $id = gettype($id) === 'string' ? (int)$id : $id;
        $query = 'DELETE FROM '. $table . ' WHERE id = ' . $id;
        return $this->executeQuery($query) === false ? false : true;
    }

    /**
     * return an array of records of the table, according to the parameters passed
     * 
     * @param string $table name of the table
     * @param array $params an array containing parameters of your research
     * @example $params '['WHERE' => 'data = value && ...', 'ORDER BY' => 'data ASC && ...', 'LIMIT' => '...']'
     * @return array|false records associate to parameters or false if an error occured or if no records are found
     */
    public function find (
        string $table,
        array $params = array('WHERE' => '1','ORDER BY' => 'id ASC','LIMIT' => '')
    ) {
        $query = 'SELECT * FROM ' . $table . ' ';
        $query .= empty($params['WHERE'])
            ? ''
            : 'WHERE ' . trim($params['WHERE']) . ' ';
        $query .= empty($params['ORDER BY'])
            ? ''
            : 'ORDER BY ' . trim($params['ORDER BY']) . ' ';
        $query .= empty($params['LIMIT'])
            ? ''
            : 'LIMIT ' . trim($params['LIMIT']);
        $output = $this->executeQuery($query);
        return $output === false 
            ? false
            : $output->fetchAll(\PDO::FETCH_ASSOC);
    }
}
