<?php


namespace main;


use PDO;
use PDOException;

class Database
{
    public static $db;

    public static function getInstans():PDO{

        if (static::$db == null){
            try {
                $config = Config::get("db");
                $dsn = $config["driver"] . ":dbname=" . $config["schema"] . ";host=" . $config["host"];
                static::$db = new PDO($dsn, $config["user"], $config["password"]);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        return static::$db;
    }
}