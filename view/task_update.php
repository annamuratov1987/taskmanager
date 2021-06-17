<?php
/** @var TYPE_NAME $data */
?>
<h3>Редактирования задача.</h3>
<form action="/task/update" method="post" class="row">
    <div class="col-6 m-auto mt-5">
        <?if(isset($data['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?=$data['error']?>
            </div>
        <?endif;?>
        <?if(isset($data['task']) && !is_null($data['task'])):?>
            <div class="col-12 mt-2">
                Имя пользователя: <?=$data['task']->user?>
            </div>
            <div class="col-12 mt-2">
                E-mail: <?=$data['task']->email?>
            </div>
            <input type="hidden" name="id" value="<?=$data['task']->id?>">
            <div class="col-12 mt-2">
                <label for="task-text" class="form-label">Текст задача</label>
                <textarea name="text" class="form-control" id="task-text"><?=$data['task']->text?></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="status" type="checkbox" value="done" id="task-done" <?=$data['task']->status=="done"?"checked='checked'":""?>>
                <label class="form-check-label" for="task-done">
                    выполнено
                </label>
            </div>
            <div class="col-12 mt-2">
                <button type="reset" class="btn btn-primary float-end m-1">Отменить</button>
                <button type="submit" class="btn btn-primary float-end m-1">Сохранить</button>
            </div>
        <?endif;?>
        <div class="col-12">
            <a class="btn btn-link" href="/" role="button">Назад</a>
        </div>

    </div>
</form>