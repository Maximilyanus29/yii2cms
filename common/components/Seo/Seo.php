<?php

namespace common\components\Seo;

use yii\helpers\Url;
use Yii;

class Seo extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'seo';
    }

    public function rules()
    {
        return [
            [['entity_id'], 'integer'],
            [['h1', 'title', 'keywords', 'description'], 'string'],
            [['entity_name'], 'string', 'max' => 255],
            [['entity_name', 'entity_id'], 'unique', 'targetAttribute' => ['entity_name', 'entity_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_name' => 'Entity Name',
            'entity_id' => 'Entity ID',
            'h1' => 'H1',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }
}
