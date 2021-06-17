<?php
/** @var TYPE_NAME $data */
?>
<hr>
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
                    <textarea name="text" class="form-control h-100" placeholder="Текст задача" required></textarea>
                </div>
                <div class="col">
                    <input type="text" name="user" class="form-control mb-2" placeholder="Имя" aria-label="Имя" required>
                    <input type="text" name="email" class="form-control mb-2" placeholder="E-mail" aria-label="E-mail" required>
                    <input type="submit" name="submit" class="form-control w-50 float-end">
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 mt-3">
        <?
        $query = '?';
        foreach ($data['query'] as $value)
            if ($value!="" && strpos($value, 'sort_by')===false && strpos($value, 'sort_type')===false)
                $query .= $value . '&';
        ?>
        <div class="btn-group">
            <button class="btn btn-light dropdown-toggle" type="button" id="sortButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Имя пользователя
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortButton1">
                <li><a class="dropdown-item" href="<?=$query?>sort_by=user&sort_type=asc">по возрастанию</a></li>
                <li><a class="dropdown-item" href="<?=$query?>sort_by=user&sort_type=desc">по убыванию</a></li>
            </ul>
            <button class="btn btn-light dropdown-toggle" type="button" id="sortButton2" data-bs-toggle="dropdown" aria-expanded="false">
                E-mail
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortButton2">
                <li><a class="dropdown-item" href="<?=$query?>sort_by=email&sort_type=asc">по возрастанию</a></li>
                <li><a class="dropdown-item" href="<?=$query?>sort_by=email&sort_type=desc">по убыванию</a></li>
            </ul>
            <button class="btn btn-light dropdown-toggle" type="button" id="sortButton3" data-bs-toggle="dropdown" aria-expanded="false">
                Статус
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortButton2">
                <li><a class="dropdown-item" href="<?=$query?>sort_by=status&sort_type=asc">по возрастанию</a></li>
                <li><a class="dropdown-item" href="<?=$query?>sort_by=status&sort_type=desc">по убыванию</a></li>
            </ul>
        </div>
    </div>
    <div class="col-12">
        <? foreach ($data['tasks'] as $task):?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?=$task->user?><span class="fs-6"> (<?=$task->email?>)</span></h5>
                    <p class="card-text"><?=$task->text?></p>
                </div>
                <div class="card-footer text-muted">
                    <span class="">Время создания: <?= $task->created_at?></span>
                    <span class="badge bg-light float-end">
                        <a href="/task/update?id=<?=$task->id?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                    </span>
                    <span class="badge float-end <?= $task->status == "done" ? "bg-success" : "bg-danger"?>"><?= $task->status=="done"?"выполнено":"не выполнено"?></span>
                    <?if($task->update_by_admin):?>
                        <span class="badge bg-info float-end me-5">отредактировано администратором</span>
                    <?endif;?>
                </div>
            </div>
        <?endforeach;?>
    </div>
    <div class="col-12">
        <?
        $query = '?';
        foreach ($data['query'] as $value)
            if ($value!="" && strpos($value, 'page')===false)
                $query .= $value . '&';
        ?>
        <nav class="p-2">
            <ul class="pagination justify-content-center">
                <?if($data['page']!=1):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$query?>page=<?=$data['page']-1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?endif;?>
                <?
                $endPage = min([$data['page_count'], $data['page']+2]);
                $beginPage = max([1, $endPage -2]);
                ?>
                <?for($i=$beginPage; $i<=$endPage; $i++):?>
                    <li class="page-item  <?=($data['page']==$i)?'active':''?>"><a class="page-link" href="<?=$query?>page=<?=$i?>"><?=$i?></a></li>
                <?endfor;?>
                <?if($data['page']!=$data['page_count']):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$query?>page=<?=$data['page']+1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?endif;?>
            </ul>
        </nav>
    </div>
</div>

