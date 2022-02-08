<?php
namespace Framework;
class DataStore{
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct($pdo, $table, $primaryKey){
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }
    private function query($sql, $parameters){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt;
    }
    private function processDates($fields){
        foreach($fields as $key => $value){
            if ($value instanceof \DateTime){
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }
    public function insert($fields){
        $query = 'INSERT INTO `' . $this->table . '`(';

        foreach($fields as $key => $value){
            $query .= '`'. $key . '`,';
        }
        $query = rtrim($query, ',');
        $query .= ') VALUES (';
        foreach($fields as $key => $value){
            $query .= ':' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ')';
        $fields = $this->processDates($fields);
        $this->query($query, $fields);
    }
    public function findById($column, $value){
        $query = 'SELECT * FROM `'. $this->table . '` WHERE '. $column . ' = :value';
        $parameters = [':value' => $value];
        $rows = $this->query($query, $parameters);
        return $rows->fetchAll();
    }
    private function update($fields){
        $query = 'UPDATE '. $this->table . ' SET ';
        foreach($fields as $key => $value){
            $query .= '`' . $key . '` = :' .$key. ', ';
        }
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        $parameters = [':primaryKey' => $fields['id']];
        $fields = $this->processDate($fields);
        $this->query($query, $fields);
    }

    public function save($record){
        try {
            if ($record[$this->primaryKey] == ''){
                $record[$this->primaryKey] = null;
                $this->insert($record);
            }
        } catch(\PDOException $e){
            $this->update($record);
        }
    }
}