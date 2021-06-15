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

