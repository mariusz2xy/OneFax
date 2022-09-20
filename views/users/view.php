<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <div class="users-view">
            <p class="float-right">
                 <?= Html::a('<span class="icon"><i class="fas fa-pen"></i></span><span class="text">Aktualizuj</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-icon-split']) ?>

                <?= Html::a('<span class="icon"><i class="fas fa-trash"></i></span><span class="text">Usuń</span>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-icon-split',
                    'data' => [
                        'confirm' => 'Czy na pewno chcesz usunąć użytkownika?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'username',
                    // 'password',
                    // 'auth_key',
                    // 'access_token',
                    'user_group_id',
                    'cl_id',
                    'create_date' => 'Data utworzenia',
                    // 'delete_flag',
                ],
            ]) ?>
        </div>
    </div>
</div>