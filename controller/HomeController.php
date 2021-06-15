<?php


namespace controller;


use main\Controller;
use model\Task;

class HomeController extends Controller
{
 public function index():void{

     $sortBy = "created_at";
     $sortType = "desc";
     if (isset($_GET['sort_by'])){
         $sortBy = $_GET['sort_by'];
     }
     if (isset($_GET['sort_type'])){
         $sortType = $_GET['sort_type'];
     }

     $data = array("page" => 1);

     if (isset($_GET['page'])){
         $data["page"] = intval($_GET['page']);
     }

     $data['page_count'] = ceil(Task::getCount() / 3);

     $data["tasks"] = Task::getByPage($data['page'], 3, $sortBy, $sortType);

     if($_REQUEST['success']){
         $data['success'] = $_REQUEST['success'];
     }

     if($_REQUEST['error']){
         $data['error'] = $_REQUEST['error'];
     }

     $query = explode('&', $_SERVER['QUERY_STRING']);
     $data['query'] = $query;

     $this->render("home", $data);
 }
}