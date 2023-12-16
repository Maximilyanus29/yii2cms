<?php

use yii\helpers\Html;

$user = Yii::$app->user->identity;

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"></span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"></span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?= $this->render('elements/_notifications-menu', compact('directoryAsset')) ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/backend/web/img/user-logo.jpg" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?= $user->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/backend/web/img/user-logo.jpg" class="img-circle" alt="User Image" />
                            <p>
                                <?= $user->username ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-pass">Смена пароля</button>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выход',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>