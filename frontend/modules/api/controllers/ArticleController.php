<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Article;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class ArticleController extends ActiveController
{
    public $modelClass = Article::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);

        return $actions;
    }

    public function actionIndex()
    {
        $articles = Article::findWhereFront()->all();

        return $articles;
    }

    public function actionView($id)
    {
        $article = Article::findWhereFront()->andWhere(['id' => $id])->one();

        if (empty($article)) {
            throw new NotFoundHttpException('Статья не найдена');
        }

        return $article;
    }
}
