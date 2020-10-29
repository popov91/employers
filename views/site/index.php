<?php

/* @var $this yii\web\View */

use app\helpers\EmployerHelper;
use app\models\EmployersLnkDepartments;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <?php foreach ($departments as $department):?>
                <th><?= $department->name ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employers as $employer): ?>
            <tr>
                <td><?= EmployerHelper::getFullName($employer) ?></td>
                <?php foreach ($departments as $department):?>
                <td> <?= EmployersLnkDepartments::checkRelation($employer, $department, $relations)  ?> </td>
                <?php endforeach ?>
            </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
