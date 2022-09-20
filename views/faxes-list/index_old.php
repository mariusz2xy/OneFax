<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
use yii\bootstrap4\BootstrapAsset;
// use yii\widgets\DetailView;
// use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
?>

<?php 
    Modal::begin([
        // 'header' => 'Test',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();
?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Lista faksów</h6>                        
                        </div>
                        <div class="card-body">
                            <p class='float-right'>
                            <?= Html::button('<span class="icon"><i class="fas fa-paper-plane"></i></span>
                                <span class="text">Wyślij Fax</span></span>', [
                                'value'=>Url::to('/faxes-list/create'), 
                                'class' => 'btn btn-primary btn-icon-split',
                                'id' => 'modalButton']
                            ) ?>
                            </p>
                            <div class="table-responsive ">
                                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th style="width:15%">Data</th>
                                            <th style="width: 3%">Rodzaj</th>
                                            <th style="width:7%">Nadawca</th>
                                            <th style="width:7%">Odbiorca</th>
                                            <th style="width: 7%">Status</th>
                                            <th>Opis</th>
                                            <th style="width: 3%">Typ</th>
                                            <th style="width: 5%">Akcje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($faxesList as $key => $faxRow) { ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $key+1 ?></td>
                                            <td class="align-middle"><?= $faxRow->date ?></td>
                                            <td class="align-middle text-center"><?php if($faxRow->direction == 'INCOMING') {$icon = 'fa-level-down-alt';$colour='blue';} else {$icon = 'fa-level-up-alt'; $colour='green';} ?><i class="fas fa-fw <?= $icon ?>" style="color: <?= $colour ?>;"></i></td>
                                            <td class="align-middle"><?= $faxRow->caller_number ?></td>
                                            <td class="align-middle"><?= $faxRow->called_number ?></td>
                                            <td class="align-middle"><?php if($faxRow->event == 'SUCCESS') $colour = 'green'; else if($faxRow->event == 'NEGOTIATION') $colour = 'blue'; else $colour = 'red'; ?><span style="color: <?= $colour ?>"><?= $faxRow->event ?></span></td>
                                            <td class="align-middle"><?= $faxRow->description ?></td>
                                            <td class="text-center align-middle"><?php if($faxRow->type == 'FAX') $icon = 'fa-fax'; else if($faxRow->type == 'WWW') $icon = 'fa-desktop'; else $icon = 'fa-at'; ?><i class="fas fa-fw <?= $icon ?>"></i></td>
                                            <td class="text-left align-middle">
                                                <?php if(isset($faxRow->faxDetails->file_name) && $faxRow->event == 'SUCCESS') {
                                                    $file_name = $faxRow->faxDetails->file_name;?>
                                                    <a id="icon" href="/faxes-list/download-file?fileName=<?= $file_name ?>"><i class="fas fa-fw fa-download"></i></a>
                                                <?php } ?>  
                                                    <a id="icon" href="/faxes-list/delete?id=<?= $faxRow->id?>"><i class="fas fa-fw fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
