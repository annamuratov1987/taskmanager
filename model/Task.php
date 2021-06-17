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

    public function __construct(string $user = null, string $email = null, string $text = null)
    {
        $this->user = $user;
        $this->email = $email;
        $this->text = $text;
        $this->status = 'active';
        $this->update_by_admin = false;
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

    public static function getByPage(int $page, int $countInPage, string $sortBy = "created_at", string $sortType = 'desc'):array
    {
        if ($sortBy != "user" && $sortBy != "email" && $sortBy != "status" && $sortBy != "created_at") $sortBy = "created_at";
        if ($sortType != "asc" && $sortType != "desc") $sortType = "desc";

        $db = Database::getInstans();
        $sql = "SELECT * FROM " . static::getTableName() . " ORDER BY " . $sortBy . " " . $sortType . " LIMIT " . $countInPage . " OFFSET " . ($countInPage * ($page - 1));

        $tasks = [];
        foreach ($db->query($sql) as $value){
            $task = new Task($value['user'], $value['email'], $value['text']);
            $task->id = $value['id'];
            $task->status = $value['status'];
            $task->created_at = $value['created_at'];
            $task->update_by_admin = $value['update_by_admin'];
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

    public static function getById(int $id = 0): ?Task
    {
        $db = Database::getInstans();
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id = ?;";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $task = new Task();
        if ($result){
            $task->id = $result['id'];
            $task->user = $result['user'];
            $task->email = $result['email'];
            $task->text = $result['text'];
            $task->status = $result['status'];
            $task->created_at = $result['created_at'];
        }else{
            return null;
        }

        return $task;
    }
}