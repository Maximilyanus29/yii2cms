<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use rico\yii2images\behaviors\ImageBehave;
use paulzi\adjacencyList\AdjacencyListBehavior;
use common\components\Seo\SeoBehavior;
use common\components\Image\ImageNameBehavior;
use Yii;

class Category extends AppModel
{
    public $images;

    public static function tableName()
    {
        return 'category';
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
            'ImageBehave' => [
                'class' => ImageBehave::class,
            ],
            'ImageNameBehavior' => [
                'class' => ImageNameBehavior::class,
            ],
            'AdjacencyListBehavior' => [
                'class' => AdjacencyListBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name',], 'required'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['parent_id'], 'integer'],
            [['sort'], 'integer'],
            [['created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [
                ['images'],
                'file',
                'skipOnEmpty' => true,
                'maxFiles' => 10,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => (10000 * 1024),
                'tooBig' => 'Размер превышает 10MB'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'slug' => 'URL',
            'parent_id' => 'Родительская категория',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'is_public' => 'Видимость',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function getChilds()
    {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }

    public function getGoods()
    {
        return $this->hasMany(Good::class, ['category_id' => 'id']);
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function findWhereFront()
    {
        return self::find()->where(['is_public' => 1, 'is_delete' => 0]);
    }
}
