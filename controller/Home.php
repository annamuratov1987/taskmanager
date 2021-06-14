<?php


namespace controller;


use main\Controller;
use model\Task;

class Home extends Controller
{
 public function index():void{

     $tasks = Task::getAll();

     $this->render("home", ["tasks" => $tasks]);
 }
}