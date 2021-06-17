<?php


namespace controller;


use main\Controller;
use model\Task;
use model\User;

class TaskController extends Controller
{
    public function create()
    {
        if (isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['text'])){

            $task = new Task($_POST['user'], $_POST['email'], $_POST['text']);

            if ($task->validateData()){
                if ($task->save()){
                    $header = 'Location: /?success=Задача успешно создал.';
                }else{
                    $header = 'Location: /?error=Ошибка создания задача!!!';
                }
                header($header);
            }else{
                header('Location: /?error=' . $task->validateDataError);
            }
        }
    }

    public function update()
    {
        $data = [];

        $data['user'] = User::getAuthUser();
        if (is_null($data['user']) || !$data['user']->isAdmin()){
            header('Location: /login');
        }

        if (isset($_REQUEST['id']) || !empty($_REQUEST['id'])){
            $task = Task::getById($_REQUEST['id']);

            if (!is_null($task)){

                if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    if ($task->text != $_POST['text']){
                        $task->text = $_POST['text'];
                        $task->update_by_admin = true;
                    }

                    if (isset($_POST['status'])){
                        $task->status = $_POST['status'];
                    }else{
                        $task->status = 'active';
                    }
                    if ($task->save()){
                        header('Location: /');
                    }
                }

                $data['task'] = $task;
            }else{
                $data['error'] = "Задача не найдено по этом ID.";
            }
        }else{
            $data['error'] = "ID задаче не задано.";
        }


        $this->render("task_update", $data);
    }
}