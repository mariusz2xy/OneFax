<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DidsListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dids-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'did') ?>

    <?= $form->field($model, 'cl_id') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'delete_flag') ?>

    <?php // echo $form->field($model, 'delete_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
