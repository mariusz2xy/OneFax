<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Logowanie';
?>
<div class="site-login ">

<div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Zaloguj się!</h1>
                                    </div>
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'login-form',
                                            'layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'horizontalCssClasses' => [
                                                'wrapper' => 'col-sm-12',
                                            ],
                                                'labelOptions' => ['class' => 'col-lg-12 control-label'],
                                            ],
                                            ]); ?>

                                            <?= $form->field($model, 'username')->textInput([
                                                'autofocus' => true,
                                                'class' => 'form-control form-control-user',
                                                'aria-describedby' => '',
                                            ]) ?>

                                            <?= $form->field($model, 'password')->passwordInput([
                                                'class' => 'form-control form-control-user',
                                                'aria-describedby' => '',
                                            ]) ?>
                                            <hr>
                                            <div class="col-lg-12" id="login_button">
                                                <?= Html::submitButton('Zaloguj', [
                                                'class' => 'btn btn-primary btn-user btn-block',
                                                'name' => 'login-button',
                                            ]) ?>
                                            </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


