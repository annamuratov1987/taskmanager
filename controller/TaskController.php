<?php


namespace controller;


use main\Controller;
use model\Task;

class TaskController extends Controller
{
    public function create()
    {
        if (isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['text'])){

            $task = new Task($_POST['user'], $_POST['email'], $_POST['text']);

            if ($task->validateData()){
                $task->save();
                header('Location: /?success=Задача успешно создал.');
            }else{
                header('Location: /?error=' . $task->validateDataError);
            }
        }
    }
}