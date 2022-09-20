<?php

use app\models\DidsList;
use app\models\Phonebook;
use yii\bootstrap4\BootstrapAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;


/* @var $this yii\web\View */
/* @var $model app\models\FaxesList */
/* @var $form ActiveForm */
?>
<div class="faxes-list-new-fax-phonebook">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'caller_number')->widget(Select2::className(),
        [
            'data' => ArrayHelper::map(DidsList::find()->orderBy('did')->where(['cl_id' => Yii::$app->user->identity->cl_id])->all(),'did', 'did'),
                'language' => 'pl',
                'options' => ['placeholder' => 'Wybierz ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
        ],
    ) ?>
        <?= $form->field($model, 'called_number')->widget(Select2::className(),
        [
            'data' => ArrayHelper::map(Phonebook::find()->orderBy('number')->where(['cl_id' => Yii::$app->user->identity->cl_id])->all(),'number', function ($description) {return $description->description.' ('.$description->number.')';}),
                'language' => 'pl',
                'options' => ['placeholder' => 'Wybierz ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
        ],
    ) ?>
        <?= $form->field($model, 'file')->fileInput()->label('<span class="icon"><i class="fas fa-plus"></i></span><span class="text">Załącz plik...</span>',['class'=>'btn btn-secondary btn-icon-split', 'style' => 'margin: 0px;',]) ->fileInput(['class'=>'sr-only']) ?>
        <hr>
        <div class="form-group">
            <?= Html::submitButton('Wyślij', ['class' => 'btn btn-success float-right col-lg-12']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- faxes-list-new-fax -->


