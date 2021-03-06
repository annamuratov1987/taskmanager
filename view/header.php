<?php
/** @var TYPE_NAME $data */
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Задачник</title>
</head>
<body>
<div class="container header p-3">
    <div class="row">
        <div class="col-6">
            <a href="/"><h1>Задачник</h1></a>
        </div>
        <div class="col-6">
            <?if(is_null($data['user'])):?>
                <a class="btn btn-light float-end" href="/login" role="button">Вход</a>
            <?else:?>
                <span><?=$data['user']->username?></span>
                <a class="btn btn-light float-end" href="/logout" role="button">Выход</a>
            <?endif;?>
        </div>
    </div>
</div>

<div class="container content">