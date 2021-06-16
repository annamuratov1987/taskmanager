<?php
/** @var TYPE_NAME $data */
?>

<form action="/login" method="post" class="row">
    <div class="col-6 m-auto mt-5">
        <?if(isset($data['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?=$data['error']?>
            </div>
        <?endif;?>
        <div class="col-12 mt-2">
            <label for="inputUsername" class="form-label">Пользователь</label>
            <input type="text" name="user" class="form-control" id="inputUsername">
        </div>
        <div class="col-12 mt-2">
            <label for="inputPassword" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="inputPassword">
        </div>
        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary float-end">Войти</button>
        </div>
    </div>
</form>