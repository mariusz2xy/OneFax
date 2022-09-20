<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaxesListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista faxów';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    Modal::begin([
        'id' => 'modal',
        'size' => 'modal-lg',
        'options' => [
            'tabindex' => false,
        ],
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><?= Html::encode($this->title) ?></h6>                        
    </div>
    <div class="card-body">
        <p class='float-right'>
        <?= Html::button('<span class="icon"><i class="fas fa-paper-plane"></i> <i class="fas fa-plus"></i> <i class="fas fa-address-book"></i></span>
            <span class="text">Wyślij z Książki</span></span>', [
            'value'=>Url::to('/faxes-list/create?phonebook=true'), 
            'class' => 'btn btn-primary btn-icon-split',
            'id' => 'modalButton',]
        ) ?>
        <?= Html::button('<span class="icon"><i class="fas fa-paper-plane"></i></span>
            <span class="text">Wyślij Fax</span></span>', [
            'value'=>Url::to('/faxes-list/create'), 
            'class' => 'btn btn-primary btn-icon-split',
            'id' => 'modalButton2']
        ) ?>
        </p>
        <div class="table-responsive ">
            <div class="faxes-list-index ">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => '{items}{summary}<br>{pager}',
                    'summary' => 'Wyświetlono <b>{begin}</b> - <b>{end}</b> z <b>{totalCount}</b> wpisów',
                    'pager' => [
                        'class' => '\yii\bootstrap4\LinkPager',
                        ],
                    'tableOptions' => [
                        'class' => 'table table-hover table-bordered',
                        ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn',
                         'contentOptions'=>[ 'style'=>'width: 1%'],
                        ],

                        [
                            'attribute' => 'date',
                            'format' => 'raw',
                            'contentOptions' => [ 'class' => 'align-middle' ],
                            'headerOptions' => ['style' => 'width:15% '],
                        ],

                        [
                            'attribute' => 'direction',
                            'format' => 'raw',
                            'filter' => false,
                            'headerOptions' => ['style' => 'width:3%'],
                            'contentOptions' => [ 'class' => 'align-middle text-center' ],
                            'value' => function ($model) {
                                if($model->direction == 'INCOMING')
                                {
                                    return '<i class="fas fa-fw fa-level-down-alt" style="color: blue;"></i>';
                                } else 
                                {
                                    return '<i class="fas fa-fw fa-level-up-alt" style="color: green;"></i>';
                                }
                            }
                        ],

                        [
                            'attribute' => 'caller_number',
                            'format' => 'raw',
                            'contentOptions' => [ 'class' => 'align-middle' ],
                            'headerOptions' => ['style' => 'width:10%'],
                        ],

                        [
                            'attribute' => 'called_number',
                            'format' => 'raw',
                            'contentOptions' => [ 'class' => 'align-middle' ],
                            'headerOptions' => ['style' => 'width:10%'],
                        ],

                        [
                            'attribute' => 'event',
                            'format' => 'raw',
                            'contentOptions' => [ 'class' => 'align-middle' ],
                            'headerOptions' => ['style' => 'width:6%'],
                            'value' => function ($model) {
                                if($model->event == 'SUCCESS')
                                {
                                    return '<span style="color: green;">'.$model->event.'</span>';
                                } else if ($model->event == 'NEGOTIATION')
                                {
                                    return '<span style="color: blue;">'.$model->event.'</span>';
                                } else
                                {
                                    return '<span style="color: red;">'.$model->event.'</span>';
                                }
                            }
                            
                        ],
                        
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                            'contentOptions' => [ 'class' => 'align-middle' ],
                        ],

                        [
                            'attribute' => 'type',
                            'format' => 'raw',
                            'filter' => false,
                            'contentOptions' => [ 'class' => 'align-middle text-center' ],
                            'headerOptions' => ['style' => 'width:3%'],
                            'value' => function ($model) {
                                if($model->type == 'WWW')
                                {
                                    return '<i class="fas fa-fw fa-desktop"></i>';
                                } else if($model->type == 'FAX')
                                {
                                    return '<i class="fas fa-fw fa-fax"></i>';
                                } else
                                {
                                    return '<i class="fas fa-fw fa-at"></i>';
                                }
                            }
                        ],

                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Akcje',
                            'template' => '{download}',
                            'headerOptions' => ['style' => 'width:4%'],
                            'contentOptions' => [ 'class' => 'align-middle' ],
                            'buttons' => 
                            [
                                'download' => function($url, $model, $key)
                                {
                                    if(isset($model->fileName) && $model->event == 'SUCCESS')
                                    {
                                            $fileName = $model->fileName;
                                            return '<a id="icon" href="/faxes-list/download-file?fileName='.$fileName.'"><i class="fas fa-fw fa-download"></i></a>';
                                    } else return '';
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

