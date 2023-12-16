<?php

use common\components\Column\Column;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Администраторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <div class="row head-page-content">
        <div class="col-sm-10">
            <h1> <?= $this->title ?> </h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Создать администратора', ['create'], ['class' => 'btn btn-primary create-btn']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'width' => '75px',
                    ],

                    'username',

                    Column::dateRangeColumn($searchModel, 'created_at', 'created_at_start', 'created_at_end'),
                    
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                    ],
                ],
            ]);
            ?>

        </div>
    </div>

</div>