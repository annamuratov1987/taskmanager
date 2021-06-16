<?php

namespace model;


class User
{
    public string $username;
    public string $password;
    public string $error;

    public static function getAuthUser(): ?User
    {
        session_start();

        if (isset($_SESSION['username']) && isset($_SESSION['password'])){
            $user = new User();
            $user->username = $_SESSION['username'];
            $user->password = $_SESSION['password'];
            return $user;
        }

        return null;
    }

    public function login():bool
    {
        if ($this->username == '' || $this->password == ''){
            $this->error = "Имя пользователь или пароль не вводил.";
            return false;
        }elseif ($this->username != 'admin' || $this->password != '123'){
            $this->error = "Имя пользователь или пароль неверный.";
            return false;
        }

        session_start();

        $_SESSION['username'] = $this->username;
        $_SESSION['password'] = $this->password;

        return true;
    }

    public function logout():bool
    {
        session_start();
        $_SESSION = array();
        return session_destroy();
    }

    public function isAdmin():bool
    {
        if ($this->username == 'admin'){
            return true;
        }
        return false;
    }
}