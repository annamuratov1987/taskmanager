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

    protected function insert()
    {
        $db = Database::getInstans();
        $sql = "INSERT INTO " . $this->getTableName() . " (";
        $values = "";

        foreach ($this->fields as $key => $field) {
            $sql .= $key . ", ";
            $values .= $db->quote($field) . ", ";
        }

        $sql = substr_replace($sql, '', -2);
        $values = substr_replace($values, '', -2);
        $sql .= ") VALUES (" . $values . ");";

        return $db->exec($sql);
    }

    protected function update()
    {
        $db = Database::getInstans();
        $sql = "UPDATE " . $this->getTableName() . " SET ";

        foreach ($this->fields as $key => $field) {
            $sql .= $key . " = " . $db->quote($field) . ", ";
        }

        $sql = substr_replace($sql, '', -2);
        $sql .= " WHERE id = " . $db->quote($this->fields["id"]) . ";";

        return $db->exec($sql);
    }

    public function save()
    {
        if (is_null($this->fields['id'])){
            return $this->insert();
        }else{
            return $this->update();
        }
    }
}