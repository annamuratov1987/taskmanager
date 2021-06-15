<?php


namespace controller;


use main\Controller;
use model\Task;

class HomeController extends Controller
{
 public function index():void{

     $tasks = Task::getAll();
     $data = array("tasks" => $tasks);

     if($_REQUEST['success']){
         $data['success'] = $_REQUEST['success'];
     }

     if($_REQUEST['error']){
         $data['error'] = $_REQUEST['error'];
     }

     $this->render("home", $data);
 }
}