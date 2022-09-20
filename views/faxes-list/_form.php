<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FaxesList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faxes-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'caller_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'called_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'call_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cl_id')->textInput() ?>

    <?= $form->field($model, 'event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'delete_flag')->textInput() ?>

    <?= $form->field($model, 'delete_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
