<?php
/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
