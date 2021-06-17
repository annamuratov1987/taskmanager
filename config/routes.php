<?php
return [
    "/" => ["controller\HomeController","index"],
    "/login" => ["controller\HomeController","login"],
    "/logout" => ["controller\HomeController","logout"],

    "/task/create" => ["controller\TaskController","create"],
    "/task/update" => ["controller\TaskController","update"]
];