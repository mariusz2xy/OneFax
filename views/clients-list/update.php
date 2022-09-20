<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientsList */

$this->title = 'Edytuj klienta: ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Clients Lists', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <div class="clients-list-update">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

        </div>
    </div>
</div>
