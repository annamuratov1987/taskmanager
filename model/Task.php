<?php


namespace model;


use main\Database;
use main\Model;

class Task extends Model
{
    public string $validateDataError = "";

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

    public function validateData(): bool
    {
        if (empty($this->fields['user'])
            || empty($this->fields['email'])
            || empty($this->fields['text'])
            || empty($this->fields['status'])
        ){
            $this->validateDataError = "Не заполнено все необходимые поля.";
            return false;
        }

        if(!preg_match("/^[a-zA-Z0-9_\-.]+@[a-z]/", $this->email)){
            $this->validateDataError = "Вводил неверный email.";
            return false;
        }

        return true;
    }

    public static function getByPage(int $page, int $countInPage):array
    {
        $db = Database::getInstans();
        $sql = "SELECT * FROM " . static::getTableName() . " LIMIT " . $countInPage . " OFFSET " . ($countInPage * ($page - 1));

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

    public static function getCount():int
    {
        $db = Database::getInstans();
        $stmt = $db->query("SELECT COUNT(*) FROM " . static::getTableName() . ";");
        $value = $stmt->fetch();
        return $value[0];
    }
}