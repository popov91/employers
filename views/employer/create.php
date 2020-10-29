<?php
/* @var $this yii\web\View */
/* @var $model app\models\Employer */
/* @var $form yii\widgets\ActiveForm */

use app\helpers\DepartmentHelper;
use app\helpers\EmployerHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'patronymic')->textInput() ?>
    <?= $form->field($model, 'gender')->radioList(EmployerHelper::getGenderList(), ['separator'=>'<br/>'])->label(false) ?>
    <?= $form->field($model, 'salary')->textInput() ?>
    <?= $form->field($model, 'departments')->checkboxList(DepartmentHelper::getDepartmentsList($departments))->label('Отделы') ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
