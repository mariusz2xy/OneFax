<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Użytkownicy';
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <p class='float-right'>
            <?= Html::a('<span class="icon"><i class="fas fa-plus"></i></span><span class="text">Dodaj użytkownika</span></span>', ['create'], ['class' => 'btn btn-primary btn-icon-split']) ?>
        </p>
        <div class="users-index">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => '{items}{summary}<br>{pager}',
                'pager' => [
                    'class' => '\yii\bootstrap4\LinkPager',
                    ],
                'summary' => 'Wyświetlono <b>{begin}</b> - <b>{end}</b> z <b>{totalCount}</b> wpisów',
                'tableOptions' => [
                    'class' => 'table table-hover table-bordered',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'groupName',
                    'clientName',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
