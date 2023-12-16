<?php

namespace backend\modules\article\controllers;

use backend\controllers\AppController;
use backend\modules\article\models\search\ArticleSearch;
use common\components\Support\Support;
use common\models\Article;
use kartik\grid\EditableColumnAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Yii;

class ArticleController extends AppController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Article();

        if ($model->load($this->request->post()) && $model->save()) {
            $model->uploadImage(UploadedFile::getInstance($model, 'image'));
            return $this->redirect(['index']);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->save()) {
            $model->uploadImage(UploadedFile::getInstance($model, 'image'));
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->removeImages();
        $model->delete();

        Yii::$app->session->setFlash('warning', "Статья $model->name удалена");

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested Article does not exist.');
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'update-grid' => [
                'class' => EditableColumnAction::class,
                'modelClass' => Article::class,
                'outputValue' => function ($model, $attribute, $key, $index) {
                    switch ($attribute) {
                        case 'is_public':
                            $result = Support::getListYesNo($model->$attribute);
                            break;
                    }
                    return $result;
                },
            ]
        ]);
    }
}
