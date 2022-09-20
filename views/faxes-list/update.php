<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaxesList */

$this->title = 'Update Faxes List: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faxes Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faxes-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
