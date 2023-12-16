<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\components\Seo\SeoBehavior;
use Yii;

class Page extends AppModel
{
    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            'SluggableBehavior' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => true,
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
            'SeoBehavior' => [
                'class' => SeoBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['text_short'], 'string', 'max' => 1000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'slug' => 'URL',
            'text_short' => 'Краткое описание',
            'text' => 'Контент',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'is_public' => 'Видимость',
        ];
    }

    public static function findWhereFront()
    {
        return self::find()->where(['is_public' => 1, 'is_delete' => 0]);
    }

    public function getLink()
    {
        $link = '/' . $this->slug;
        return $link;
    }
}
