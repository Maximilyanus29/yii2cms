<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                Вышеупомянутая ошибка произошла, когда веб-сервер обрабатывал ваш запрос на сайте <br>
                Пожалуйста, перейдите на <a href='<?= Yii::$app->homeUrl ?>'>главную страницу</a>
            </p>

        </div>
    </div>

</section>
