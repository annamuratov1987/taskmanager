<?php
/** @var TYPE_NAME $data */
?>

<?if(isset($data['success'])):?>
    <div class="alert alert-success" role="alert">
        <?=$data['success']?>
    </div>
<?endif;?>

<?if(isset($data['error'])):?>
    <div class="alert alert-danger" role="alert">
        <?=$data['error']?>
    </div>
<?endif;?>

<div class="row">
    <div class="col-12">
        <h5>Создать задача</h5>
        <form action="/task/create" method="post">
            <div class="row">
                <div class="col">
                    <textarea name="text" class="form-control h-100" placeholder="Текст задача"></textarea>
                </div>
                <div class="col">
                    <input type="text" name="user" class="form-control mb-2" placeholder="Имя" aria-label="Имя">
                    <input type="text" name="email" class="form-control mb-2" placeholder="E-mail" aria-label="E-mail">
                    <input type="submit" name="submit" class="form-control w-50 float-end">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <? foreach ($data['tasks'] as $task):?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?=$task->user?></h5>
                    <p class="card-text"><?=$task->text?></p>
                </div>
                <div class="card-footer text-muted">
                    <span class="">Время создания: <?= $task->created_at?></span>
                    <span class="badge float-end <?= $task->status == "closed" ? "bg-success" : "bg-danger"?>">Статус: <?= $task->status?></span>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>