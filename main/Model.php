<?php

namespace main;

use PDO;

abstract class Model
{
    protected array $fields;

    abstract static function getTableName():string;

    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
    }

    public function __get($name)
    {
        if (key_exists($name, $this->fields))
            return $this->fields[$name];

        return null;
    }

    protected function insert():bool
    {
        $db = Database::getInstans();
        $sql = "INSERT INTO " . $this->getTableName() . " (";
        $values = [];

        foreach ($this->fields as $key => $field) {
            $sql .= $key . ", ";
            $values[] = htmlspecialchars($field);
        }
        $sql = substr_replace($sql, '', -2);
        $sql .= ") VALUES (";

        for ($i=0; $i<count($values); $i++){
            $sql .= "?, ";
        }
        $sql = substr_replace($sql, '', -2);
        $sql .= ")";

        $stmt = $db->prepare($sql);
        return $stmt->execute($values);
    }

    protected function update():bool
    {
        $db = Database::getInstans();
        $sql = "UPDATE " . $this->getTableName() . " SET ";
        $values = [];

        foreach ($this->fields as $key => $field) {
            $sql .= $key . " = ?, ";
            $values[] = htmlspecialchars($field);
        }

        $sql = substr_replace($sql, '', -2);
        $sql .= " WHERE id = " . $this->fields["id"] . ";";

        $stmt = $db->prepare($sql);
        return $stmt->execute($values);
    }

    public function save()
    {
        if (isset($this->fields['id']) && !is_null($this->fields['id'])){
            return $this->update();
        }else{
            return $this->insert();
        }
    }
}