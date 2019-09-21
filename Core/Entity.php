<?php

namespace Core;

use Core\ORM;

abstract class Entity
{
    /**
     * @var int $id id of the entity
     */
    protected $id = null;

    /**
     * @var string $table name of the table
     */
    protected $table = '';

    /**
     * @var object $orm orm instance
     */
    private $orm = null;

    /**
     * construct instance of the entity
     * WARNING : TABLE PARAM HAS TO BE PASSED TO USE ENTITY METHODS ON ORM
     * 
     * @param string $table table associate to the entity
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->orm = new ORM();
    }

    /**
     * set id of the entity
     * 
     * @param int $id id that will be set
     * @return object instance of the current object to chain
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * call create method on ORM to insert values in a table and set id on the model
     * 
     * @return int|bool return id of the new row of your database or false if an error occure
     */
    public function save()
    {
        $id = $this->orm->create($this->table, $this->reflectProperties());
        $this->setId($id);
        return $id;
    }

    /**
     * load properties of the model according to his id, call setters
     * 
     * @return object|bool return instance of the model for chained requests or false if an error occured
     */
    public function load()
    {
        if($this->id === null || $this->getRecord($this->id) === false) {
            return false;
        }
        foreach($this->orm->read($this->table, $id) as $property => $value) {
            $setter = 'set' . ucfirst($property);
            $this->$setter($value);
        }
        return $this;
    }

    /**
     * call read method of ORM to get record in a table according to id passed, work only if id is set on the model or passed in parameters
     * 
     * @param string|int $id id associate to records, initated to id of th model if not passed
     * @param bool $relations set to false if you don't want relations associate to the result
     * @return array records associate to $id
     */
    public function getRecord($id = null)
    {
        $id = $id === null ? $this->id : $id;
        $output = $this->orm->read($this->table, $id);
        $relationsProperty = $this->getRelationProperty();
        if(isset($relationsProperty[0]) && $id !== null) {
            $output = array_merge(
                $output,
                $this->findRelations(
                    $this->table,
                    $id,
                    $relationsProperty
                )
            );
        }
        return $output;
    }

    /**
     * call update method of ORM to change records in a table, work only if id is set on the model or passed in parameters
     * 
     * @param array $fields fields associate to their new values
     * @param int|string $id id of the user, initated to id of the model if not passed
     * @return bool true if request succeed or false if an error occured
     */
    public function changeInfos(array $fields, $id = null)
    {
        $id = $id === null ? $this->id : $id;
        return $this->orm->update($this->table, $id, $fields);
    }

    /**
     * call delete method of ORM to delete records in a table, work only if id is set on the model or passed in parameters
     * 
     * @param string|int $id id associate to the records, initated to id of the model if not passed
     * @return bool true if request suceed or false if an error occured
     */
    public function deleteRecords($id = null)
    {
        $id = $id === null ? $this->id : $id;
        return $this->orm->delete($this->table, $id);
    }

    /**
     * call find method of ORM to get records in a table according to parameters passed
     * 
     * @param array $params an array containing parameters of your research
     * @example $params '['WHERE' => 'data = value && ...', 'ORDER BY' => 'data ASC && ...', 'LIMIT' => '...']'
     * @return array|false records associate to parameters or false if an error occured
     */
    public function fetch(array $params = array('WHERE' => '1','ORDER BY' => 'id ASC','LIMIT' => ''))
    {
        $output = $this->orm->find($this->table, $params);
    
        $relationsProperty = $this->getRelationProperty();
        if(isset($relationsProperty[0]) && $output !== false) {
            foreach($output as $index => $value) {
                $output[$index] = array_merge(
                    $output[$index],
                    $this->findRelations(
                        $this->table,
                        $value['id'],
                        $relationsProperty
                    )
                );
            }
        }
        return $output;
    }

    /**
     * reflection iteration on properties
     */
    private function reflectProperties()
    {
        $reflectObj  = new \ReflectionClass($this);
        $properties = [];
        foreach($reflectObj->getProperties() as $property) {
            $property->setAccessible(true);
            if(!in_array($property->name, ['orm', 'table', 'id', 'relations'])) {
                $properties[$property->name] = $property->getValue($this);
            }
        }
        return $properties;
    }

    /**
     * reflection iteration for relations on table
     * 
     * @param object $object object associate to relations function returns
     * @return array array of strings containing relation infos
     */
    private function getRelationProperty($object = null)
    {
        if($object === null) {
            $object = $this;
        }
        $reflectObj = new \ReflectionClass($object);
        foreach($reflectObj->getProperties() as $property) {
            if($property->name === 'relations') {
                $property->setAccessible(true);
                return $property->getValue($this);
            }
        }
    }

    /**
     * add relation values to tables on relations many to many
     * 
     * @param int|string $id id of the user, initated to id of the model if not passed 
     * @param string $table name of the table to link (once you specified relations in the model)
     * @param array $linkedTo array of ids to link
     * @param bool set to true if you want to set all new relations and erase olds, or to false if you want to keep olds
     */
    public function linkRelation(string $table, array $linkedTo, $conservation = false, $identifier = null)
    {
        $identifier = $identifier === null ? $this->id : $identifier;
        if($identifier === null) {
            die('ERROR : BAD USAGE OF THE FRAMEWORK, ID NOT SET');
        }
        $relations = $this->getRelationProperty();
        $boolTester = false;
        $lateRelations = [];
        foreach($relations as $order) {
            if(preg_match('/has many '.$table.'/', $order) === 1) {
                $boolTester = true;
            }
        }
        if($boolTester === true) {
            $boolTester = false;
            $distantModel = $table . 'Model';
            $associateRelation = $this->getRelationProperty('App\\Model\\' . $distantModel);
            foreach($associateRelation as $distantRelations) {
                if(preg_match('/has many ' . $this->table . '/', $distantRelations) === 1) {
                    $boolTester = true;
                    $array = [$this->table, $table];
                    sort($array, SORT_STRING);
                    $crossTable = implode('_', $array);
                    if($conservation === true) {
                        $toDelete = $this->orm->find($crossTable, ['WHERE' => $this->table . '_id = ' . $identifier]);
                        foreach($toDelete as $value) {
                            $this->orm->delete($crossTable, $value['id']);
                        }
                    }
                    foreach($linkedTo as $id) {
                        $this->orm->create($crossTable, [
                            $table . '_id' => $id,
                            $this->table . '_id' => $identifier
                        ]);
                    }
                }
            }
            if($boolTester === false) {
                die('ERROR : BAD USAGE OF THE FRAMEWORK, RELATIONS NOT SET');
            }
        }
        else {
            die('ERROR : BAD USAGE OF THE FRAMEWORK, RELATIONS NOT SET');
        }
    }

    /**
     * find associations in tables by relations given
     * 
     * @param string $table name of the table
     * @param int $id id associate to the record
     * @param array $relations array containing relations : ['has many ...', 'has one ...']
     * @return array array of associations to merge
     */
    private function findRelations(string $table, int $id, array $relations)
    {
        $output = [];
        $regexMatch = [];
        $many = '/has many (.*)/';
        $one = '/has one (.*)/';
        foreach($relations as $order) {
            if(preg_match($many, $order, $regexMatch) === 1) {
                $relateModel = ucfirst(trim($regexMatch[1])) . 'Model';
                $associateRelation = $this->getRelationProperty('App\\Model\\'.$relateModel);
                foreach($associateRelation as $distantRelations) {
                    if(preg_match('/has many ' . $table . '/', $distantRelations) === 1) {
                        $array = [$table, $regexMatch[1]];
                        sort($array, SORT_STRING);
                        $crossTable = implode('_', $array);
                        $fetched = $this->orm->find($crossTable, ['WHERE' => $table . '_id = ' . $id]);
                        foreach($fetched as $results) {
                            $output[$regexMatch[1]][] = $this->orm->read($regexMatch[1], $results[$regexMatch[1] . '_id']);
                        }
                    } else if(preg_match('/has one ' . $table . '/', $distantRelations) === 1) {
                        $output[$regexMatch[1]] = $this->orm->find(
                            $regexMatch[1],
                            ['WHERE' => $table . '_id = ' . $id]
                        );
                    }
                }
            } else if(preg_match($one, $order, $regexMatch) === 1) {
                $relateModel = ucfirst($regexMatch[1]) . 'Model';
                $associateRelation = $this->getRelationProperty('App\\Model\\'.$relateModel);
                foreach($associateRelation as $distantRelations) {
                    if(preg_match('/has (one|many) ' . $table . '/', $distantRelations) === 1) {
                        $output[$regexMatch[1]] = $this->orm->read(
                            $regexMatch[1],
                            $this->orm->read($table, $id)[$regexMatch[1] . '_id']
                        );
                    }
                }
            }
        }
        return $output;
    }
}
