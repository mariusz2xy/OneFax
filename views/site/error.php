<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <!-- Error Text -->
    <div class="row justify-content-center">
        <div class="error mx-auto" data-text="<?= Html::encode($this->title) ?>"><?= Html::encode($this->title) ?></div>
    </div>
    <div class="text-center">
        <p class="lead text-gray-800 mb-5"><?= nl2br(Html::encode($message)) ?></p>
        <p class="text-gray-500 mb-0">Wygląda na to, że znalazłeś błąd w Matrixie...</p>
        <a href="/faxes-list/index">&larr; Powrót do strony głównej</a>
    </div>

</div>
