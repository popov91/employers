<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($editForm, 'name')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
