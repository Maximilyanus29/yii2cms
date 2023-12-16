<?php

namespace common\components\Image;

use Yii;

class Image extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'image';
    }

    public function rules()
    {
        return [
            [['filePath', 'modelName', 'urlAlias'], 'required'],
            [['itemId', 'isMain'], 'integer'],
            [['filePath', 'urlAlias'], 'string', 'max' => 400],
            [['modelName'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 80],
            [['text'], 'string', 'max' => 254],
        ];
    }

}