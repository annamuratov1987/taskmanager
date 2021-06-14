<?php


namespace model;


use main\Database;
use main\Model;

class Task extends Model
{

    static function getTableName(): string
    {
        return "tasks";
    }

    public function __construct(string $user, string $email, string $text)
    {
        $this->user = $user;
        $this->email = $email;
        $this->text = $text;
        $this->status = 'active';
    }


    public static function getAll()
    {
        $db = Database::getInstans();
        $sql = "SELECT * FROM " . static::getTableName() . ";";

        $tasks = [];
        foreach ($db->query($sql) as $value){
            $task = new Task($value['user'], $value['email'], $value['text']);
            $task->id = $value['id'];
            $task->status = $value['status'];
            $task->created_at = $value['created_at'];
            $tasks[] = $task;
        }

        return $tasks;
    }

}