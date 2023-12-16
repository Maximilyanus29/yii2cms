<?php

namespace backend\modules\goods\controllers;

use backend\controllers\AppController;
use backend\modules\goods\models\search\GoodSearch;
use common\components\Support\Support;
use common\models\Good;
use kartik\grid\EditableColumnAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Yii;

class GoodController extends AppController
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
        $searchModel = new GoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Good();

        if ($model->load($this->request->post()) && $model->validate() && $model->save()) {

            $model->uploadImage(UploadedFile::getInstance($model, 'image'));
            return $this->redirect(['index']);
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

        Yii::$app->session->setFlash('warning', "Товар $model->name удален");

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Good::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested good does not exist.');
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'update-grid' => [
                'class' => EditableColumnAction::class,
                'modelClass' => Page::class,
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
