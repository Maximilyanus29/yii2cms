<?php

$this->title = 'Редактирование страницы: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';

?>
<div class="item-update">

    <h1> <?= $this->title ?> </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>