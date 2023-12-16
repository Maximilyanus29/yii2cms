<?php

use yii\helpers\Html;

backend\assets\AppAsset::register($this);
backend\assets\AdminLteAsset::register($this);

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

<body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    
    <div class="wrapper">

        <?= $this->render('header') ?>

        <?= $this->render('left') ?>

        <?= $this->render('content', compact('content')) ?>

        <?= $this->render('modals') ?>

    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
