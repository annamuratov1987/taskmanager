<?php


namespace main;


class Controller
{
    public function pageNotFound():void{
        echo "404 Page not found!";
    }

    public function render(string $template, array $data = []):void{
        require_once $_SERVER["DOCUMENT_ROOT"]. "/view/header.php";
        require_once $_SERVER["DOCUMENT_ROOT"]. "/view/" . $template . ".php";
        require_once $_SERVER["DOCUMENT_ROOT"]. "/view/footer.php";
    }
}