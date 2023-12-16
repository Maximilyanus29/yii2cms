<?php

namespace frontend\modules\api\models;

use common\models\Article as ModelsArticle;
use Yii;
use yii\helpers\Url;

class Article extends ModelsArticle
{
    public function fields()
    {
        return [
            'id',
            'name',
            'slug',
            'text_short',
            'text',
            'image' => function($model){
                return Url::base(true) . str_replace('../..', '', $model->getImage()->getPath('500x'));
            },
            'date_created' => function($model){
                return date('d.m.y H:i:s', $model->created_at);
            },
            'date_updated' => function($model){
                return date('d.m.y H:i:s', $model->updated_at);
            },
        ];
    }
}
