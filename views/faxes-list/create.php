<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaxesList */

$this->title = 'Create Faxes List';
$this->params['breadcrumbs'][] = ['label' => 'Faxes Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faxes-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
