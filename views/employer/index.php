<?php
/* @var $this yii\web\View */

use app\helpers\EmployerHelper;

?>
<h1>Сотрудники</h1>

<div class="row">
    <a style="padding-left: 15px">Добавить нового сотрудника</a><br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>З/п</th>
            <th>Отделы</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employers as $employer): ?>
            <tr>
                <td><?= $employer->name ?></td>
                <td><?= $employer->surname ?></td>
                <td><?= $employer->patronymic ?></td>
                <td><?= EmployerHelper::getGenderName($employer->gender) ?></td>
                <td><?= $employer->salary ?></td>
                <td><?= $employer->findAllDepartments($employer) ?></td>
                <td><a>Изменить </a><a>Удалить</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>