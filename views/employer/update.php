<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

use app\helpers\DepartmentHelper;
use app\helpers\EmployerHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($editForm, 'name')->textInput() ?>
    <?= $form->field($editForm, 'surname')->textInput() ?>
    <?= $form->field($editForm, 'patronymic')->textInput() ?>
    <?= $form->field($editForm, 'gender')->radioList(EmployerHelper::getGenderList(), ['separator'=>'<br/>'])->label(false) ?>
    <?= $form->field($editForm, 'salary')->textInput() ?>
    <?= $form->field($editForm, 'departments')->checkboxList(DepartmentHelper::getDepartmentsList($departments))->label('Отделы') ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
