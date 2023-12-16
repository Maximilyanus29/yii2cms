<?php

use yii\helpers\Html;

$this->title = 'Создать раздел';
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
