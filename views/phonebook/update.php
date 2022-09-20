<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Phonebook */

$this->title = 'Aktualizuj wpis: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Phonebooks', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <div class="phonebook-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
