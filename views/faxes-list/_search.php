<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FaxesListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faxes-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'caller_number') ?>

    <?= $form->field($model, 'called_number') ?>

    <?= $form->field($model, 'direction') ?>

    <?= $form->field($model, 'call_id') ?>

    <?php // echo $form->field($model, 'cl_id') ?>

    <?php // echo $form->field($model, 'event') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'delete_flag') ?>

    <?php // echo $form->field($model, 'delete_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
