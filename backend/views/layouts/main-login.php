<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\AssetBundle;

dmstr\web\AdminLteAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="/favicon.ico" /> 
    <?php $this->head() ?>
</head>

<body class="login-page">

    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>