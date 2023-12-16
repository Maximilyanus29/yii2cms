<?php

use common\components\Column\Column;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="item-index">

    <div class="row head-page-content">
        <div class="col-sm-10">
            <h1> <?= $this->title ?> </h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-primary create-btn']) ?>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Column::imageColumn(),
            'name',
            'slug',
            Column::editableColumn($model, 'is_public', 'Видимость', '/goods/good/update-grid'),
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>