<?php
/* @var $this yii\web\View */
?>
<h1>Отделы</h1>

<div class="row">
    <a style="padding-left: 15px">Добавить новый отдел</a> <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество сотрудников</th>
            <th>Максимальная з/п</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td><?= $department->name ?></td>
                <td><?= $calculator->getEmployersCount($department->id) ?></td>
                <td><?= $calculator->getMaxEmployersSalary($department->id) ?></td>
                <td><a>Изменить </a><a>Удалить</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>