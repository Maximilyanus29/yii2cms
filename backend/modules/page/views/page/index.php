<?php

use common\components\Column\Column;
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <div class="row head-page-content">
        <div class="col-sm-10">
            <h1> <?= $this->title ?> </h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-primary create-btn']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'slug',
            Column::editableColumn($model, 'is_public', 'Видимость', '/page/page/update-grid'),
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>