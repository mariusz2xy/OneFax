<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\ClientsList;
use app\models\UserGroups;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'user_group_id')->textInput() ?> -->
    <?= $form->field($model, 'user_group_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(UserGroups::find()->orderBy('name')->all(),'id', 'name'),
        'language' => 'pl',
        'options' => ['placeholder' => 'Wybierz ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'cl_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(ClientsList::find()->orderBy('name')->all(),'id', 'name'),
        'language' => 'pl',
        'options' => ['placeholder' => 'Wybierz ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
