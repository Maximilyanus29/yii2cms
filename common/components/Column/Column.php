<?php

namespace common\components\Column;

use common\components\Support\Support;
use kartik\daterange\DateRangePicker;
use kartik\editable\Editable;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class Column
{
    public static function editableColumn($model, $attribute, $name, $actionPath)
    {
        return [
            'attribute' => $attribute,
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions' => [
                'formOptions' => ['action' => [$actionPath]],
                'header' => 'значение',
                'inputType' => Editable::INPUT_CHECKBOX,
                'options' => [
                    'label' => $name,
                ],
                'pjaxContainerId' => 'pjax-table',
            ],
            'content' => Support::getListYesNo($model->$attribute),
            'format' => 'boolean',
            'filter' => Support::getListYesNo(),
            'label' => $name,
        ];
    }

    public static function imageColumn($size = '80px')
    {
        return [
            'label' => 'Изображение',
            'format' => 'raw',
            'options' => ['style' => 'width: ' . $size . '; max-width: ' . $size . ';'],
            'contentOptions' => ['style' => 'width: ' . $size . '; max-width: ' . $size . ';'],
            'value' => function ($model) use ($size) {
                return Html::img(Url::toRoute($model->getImage()->getPath($size . 'x' . $size)), [
                    'style' => 'width:' . $size . ';'
                ]);
            },
        ];
    }

    public static function dateRangeColumn($searchModel, $attribute, $attribute_start, $attribute_end, $size = '250px')
    {
        return [
            'attribute' => $attribute,
            'width' => $size,
            'value' => function ($model) use ($attribute) {
                return date('d.m.Y', $model->$attribute);
            },
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => $attribute,
                'convertFormat' => true,
                'useWithAddon' => true,
                'language' => 'ru',
                'hideInput' => true,
                'presetDropdown' => true,
                'startAttribute' => $attribute_start,
                'endAttribute' => $attribute_end,
                'pluginOptions' => [
                    'locale' => ['format' => 'd.m.Y'],
                    'separator' => ' - ',
                    'opens' => 'right',
                    'showDropdowns' => true
                ],
            ]),
        ];
    }
}
