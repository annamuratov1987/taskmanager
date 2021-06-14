<?php


namespace main;


class Config
{
    public static function get($key):array{
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/config/" . $key . ".php")){
            return include($_SERVER["DOCUMENT_ROOT"]."/config/" . $key . ".php");
        }

        return array();
    }
}