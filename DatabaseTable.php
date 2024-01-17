<?php

namespace CSY2028;

//  Database class
class DatabaseTable
{
    private $pdo;
    private $table;
    private $primarykey;
    private $entityClass;
    private $entityConstructor;

    //  CONSTRUCTOR
    public function __construct($pdo, $table, $primarykey, $entityClass = 'stdclass', $entityConstructor = [])
    {
        $this->table = $table;
        $this->pdo = $pdo;
        $this->primarykey = $primarykey;
        $this->entityClass = $entityClass;
        $this->entityConstructor = $entityConstructor;
    }

    //  this function will return  specific/restricted data according to it's value
    public function find($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }
    //  this function will return all data which is available in database
    public function findAll()
    {
        $stmt = $this->pdo->prepare($sql = 'SELECT * FROM ' . $this->table);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,  $this->entityClass, $this->entityConstructor);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //  This insert function is used to Insert record into database
    public function insert($record)
    {
        $keys = array_keys($record);
        $values = implode(', ', $keys);

        $valuesWithColon = implode(', :', $keys);

        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
    }

    //  This delete function is to remove a record from the database
    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primarykey . ' = :id');
        $criteria = [
            'id' => $id
        ];
        $stmt->execute($criteria);
    }

    //  This save function is use to save a record
    function save($record)
    {
        try {
            $this->insert($record);
        } catch (\Exception $e) {
            $this->update($record);
        }
    }

    //  This update function is to update a record 
    public function update($record)
    {

        $query = 'UPDATE ' . $this->table . ' SET ';
        $parameters = [];

        foreach ($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }
        $query .= implode(', ', $parameters);

        $query .= ' WHERE ' . $this->primarykey . ' = :primarykey';

        $record['primarykey'] = $record[$this->primarykey];

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
    }
}
