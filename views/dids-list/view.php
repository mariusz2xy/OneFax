<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DidsList */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Dids Lists', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <div class="dids-list-view">
            <p class="float-right">
                 <?= Html::a('<span class="icon"><i class="fas fa-pen"></i></span><span class="text">Aktualizuj</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-icon-split']) ?>

                <?= Html::a('<span class="icon"><i class="fas fa-trash"></i></span><span class="text">Usuń</span>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-icon-split',
                    'data' => [
                        'confirm' => 'Czy na pewno chcesz usunąć numer?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'did',
                    'cl_id',
                    'create_date',
                    'delete_flag',
                    'delete_date',
                ],
            ]) ?>

        </div>
    </div>
</div>
