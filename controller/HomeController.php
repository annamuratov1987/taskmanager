<?php


namespace controller;


use main\Controller;
use model\Task;

class HomeController extends Controller
{
 public function index():void{

     $data = array("page" => 1);

     if (isset($_GET['page'])){
         $data["page"] = intval($_GET['page']);
     }

     $data['page_count'] = ceil(Task::getCount() / 3);

     $data["tasks"] = Task::getByPage($data['page'], 3);

     if($_REQUEST['success']){
         $data['success'] = $_REQUEST['success'];
     }

     if($_REQUEST['error']){
         $data['error'] = $_REQUEST['error'];
     }

     $this->render("home", $data);
 }
}