<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use rico\yii2images\behaviors\ImageBehave;
use common\components\Image\ImageNameBehavior;
use common\components\Seo\SeoBehavior;
use Yii;

class Good extends AppModel
{
    public $images;

    public static function tableName()
    {
        return 'good';
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
        ];
    }

    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['description'], 'string'],
            [['price', 'old_price'], 'number'],
            [['category_id'], 'integer'],
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
            'price' => 'Цена',
            'description' => 'Описание',
            'images' => 'Изображения',
            'old_price' => 'Старая цена',
            'category_id' => 'Категория',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'is_public' => 'Видимость',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public static function findWhereFront()
    {
        return self::find()->where(['is_public' => 1, 'is_delete' => 0]);
    }

    public function getLink()
    {
        return "/good/" . $this->slug;
    }
}
