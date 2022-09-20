<?php

use app\models\ClientsList;
use yii\bootstrap4\BootstrapAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\DidsList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dids-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'did')->label('Numer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cl_id')->label('Klient')->widget(Select2::className(),
        [
            'data' => ArrayHelper::map(ClientsList::find()->orderBy('name')->all(),'id', 'name'),
                'language' => 'pl',
                'options' => ['placeholder' => 'Wybierz ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            'options' => [
                'placeholder' => 'Wybierz ...',

            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ],
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
