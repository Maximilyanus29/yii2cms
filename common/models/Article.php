<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use rico\yii2images\behaviors\ImageBehave;
use common\components\Seo\SeoBehavior;
use common\components\Image\ImageNameBehavior;
use Yii;

class Article extends AppModel
{
    public $image;

    public static function tableName()
    {
        return 'article';
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
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['article_category_id', 'created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['text_short'], 'string', 'max' => 1000],
            [
                ['image'],
                'file',
                'skipOnEmpty' => true,
                'maxFiles' => 1,
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
            'article_category_id' => 'Категория',
            'name' => 'Наименование',
            'slug' => 'URL',
            'text_short' => 'Краткое описание',
            'text' => 'Контент',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'is_public' => 'Видимость',
            'image' => 'Изображение',
        ];
    }

    public function getArticleCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'article_category_id']);
    }

    public static function findWhereFront()
    {
        return self::find()->where(['is_public' => 1, 'is_delete' => 0]);
    }

    public function getLink()
    {
        $link = "/" . $this->slug;

        if (!empty($this->articleCategory)) {
            $link = "/" . $this->articleCategor->slug . $link;
        }

        return $link;
    }
}
